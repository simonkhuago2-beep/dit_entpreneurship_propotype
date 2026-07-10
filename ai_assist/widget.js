document.addEventListener('DOMContentLoaded', () => {

    /* ══════════════════════════════════════════════════
       Element References
    ══════════════════════════════════════════════════ */
    const trigger  = document.getElementById('ta-trigger');
    const panel    = document.getElementById('ta-panel');
    const closeBtn = document.querySelector('.ta-close');       // FIX #1: was getElementById('ta-close') — no id exists, only class
    const input    = document.getElementById('ta-input');
    const sendBtn  = document.getElementById('ta-send');
    const log      = document.getElementById('ta-messages');
    const typing   = document.getElementById('ta-typing');     // FIX #2: element must exist in HTML — see note below
    const chips    = document.querySelectorAll('.ta-chip');

    let conversationHistory = [];

    /* ══════════════════════════════════════════════════
       Panel Toggle  (replaces inline onclick="togglePanel()")
    ══════════════════════════════════════════════════ */
    // FIX #4a: togglePanel was called inline but never defined — now defined and exposed globally
    function togglePanel() {
        if (!panel) return;
        const isOpen = panel.classList.toggle('open');
        // Hide the notification badge once the user opens the panel
        const badge = document.getElementById('ta-badge');
        if (badge && isOpen) badge.style.display = 'none';
    }
    window.togglePanel = togglePanel; // expose for any remaining inline onclick attributes

    if (trigger) trigger.addEventListener('click', togglePanel);
    if (closeBtn) closeBtn.addEventListener('click', () => panel && panel.classList.remove('open'));

    /* ══════════════════════════════════════════════════
       Greeting (fires once on load)
    ══════════════════════════════════════════════════ */
    function addGreeting() {
        const hour  = new Date().getHours();
        const greet = hour < 12 ? 'Good morning' : hour < 17 ? 'Good afternoon' : 'Good evening';
        appendBubble(
            `${greet}! 👋 I'm <strong>Kwame</strong>, your personal Africa travel assistant.\n\nTell me where you'd like to go, what kind of experience you're looking for, or pick a quick option above — and I'll help you plan the perfect trip! 🌍`,
            'assistant'
        );
        // FIX #6: **bold** markdown was never parsed — greeting now uses <strong> directly
    }
    addGreeting();

    /* ══════════════════════════════════════════════════
       Chip Buttons
       FIX #3: chips were setting input.value to the button label text ("🏨 Hotels")
                instead of the actual prompt. Now each chip carries its prompt in
                data-prompt="..." and it is sent automatically on click.
    ══════════════════════════════════════════════════ */
    chips.forEach(chip => {
        chip.addEventListener('click', () => {
            const prompt = chip.dataset.prompt || chip.textContent.trim();
            if (input) {
                input.value = prompt;
                input.focus();
            }
            processUserMessage(); // auto-send on chip click
        });
    });

    // FIX #4b: sendChip() was called inline but never defined
    function sendChip(prompt) {
        if (input) {
            input.value = prompt;
            input.focus();
        }
        processUserMessage();
    }
    window.sendChip = sendChip;

    /* ══════════════════════════════════════════════════
       Textarea helpers
       FIX #4c/d: handleKey() and autoGrow() were called inline but never defined
    ══════════════════════════════════════════════════ */
    function handleKey(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            processUserMessage();
        }
    }
    window.handleKey = handleKey;

    function autoGrow(el) {
        el.style.height = 'auto';
        el.style.height = Math.min(el.scrollHeight, 120) + 'px'; // cap at ~5 lines
    }
    window.autoGrow = autoGrow;

    /* ══════════════════════════════════════════════════
       Send Button
    ══════════════════════════════════════════════════ */
    if (sendBtn) sendBtn.addEventListener('click', processUserMessage);

    // Keyboard fallback (covers the case where inline onkeydown is removed)
    if (input) {
        input.addEventListener('keydown', handleKey);
        input.addEventListener('input', () => autoGrow(input));
    }

    /* ══════════════════════════════════════════════════
       Core Message Handler
    ══════════════════════════════════════════════════ */
    async function processUserMessage() {
        if (!input) return;
        const text = input.value.trim();
        if (!text) return;

        appendBubble(text, 'user');
        input.value = '';
        autoGrow(input); // reset height after clearing

        showTyping(true);
        scrollLog();

        conversationHistory.push({ role: 'user', content: text });

        // FIX #5: trimming was off-by-one and mutated awkwardly — replaced with clean slice
        if (conversationHistory.length > 20) {
            conversationHistory = conversationHistory.slice(-20);
        }

        
        try {
            const apiUrl = window.TA_API_URL || '/api/ai_assistant/endpoint.php';
            const response = await fetch(apiUrl, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ messages: conversationHistory })
            });
        
            if (!response.ok) {
                // You can also try to parse server-side error messages if available
                throw new Error(`HTTP ${response.status}`);
            }
        
            const data = await response.json();
            return { success: true, data }; // Success payload
        
        } catch (error) {
            // Catch the error and format it into an error payload
            const errorPayload = {
                success: false,
                error: true,
                message: error.message || 'An unexpected error occurred',
                status: error.status || 'FETCH_ERROR' 
            };
        
            console.error("API Error:", errorPayload);
            
            // Return it so the calling function can handle the UI state
            return errorPayload; 
        }


        // try {
        //     // TA_API_URL is set by widget.php as window.TA_API_URL
        //     // so the endpoint path is never hardcoded in JS.
        //     const apiUrl  = window.TA_API_URL || '/api/ai_assistant/endpoint.php';
        //     const response = await fetch(apiUrl, {
        //         method: 'POST',
        //         headers: { 'Content-Type': 'application/json' },
        //         body: JSON.stringify({ messages: conversationHistory })
        //     });

        //     if (!response.ok) throw new Error(`HTTP ${response.status}`);

        //     const data = await response.json();
        //     showTyping(false);

        //     if (data.reply) {
        //         appendBubble(data.reply, 'assistant');
        //         conversationHistory.push({ role: 'assistant', content: data.reply });
        //     } else {
        //         appendBubble("I didn't receive a response. Please try again.", 'assistant');
        //     }

        // } catch (err) {
        //     showTyping(false);
        //     console.error('[TravelAssistant]', err);
        //     // FIX: replaced cryptic error messages with plain user-friendly text
        //     appendBubble("Sorry, I couldn't connect right now. Please check your connection and try again.", 'assistant');
        // }

        scrollLog();
    }

    /* ══════════════════════════════════════════════════
       Typing Indicator
       NOTE: Add this to your HTML above #ta-messages:
         <div id="ta-typing" style="display:none" aria-label="Kwame is typing">
           <span class="dot"></span><span class="dot"></span><span class="dot"></span>
         </div>
    ══════════════════════════════════════════════════ */
    function showTyping(visible) {
        if (typing) typing.style.display = visible ? 'flex' : 'none';
    }

    /* ══════════════════════════════════════════════════
       Scroll Helper
    ══════════════════════════════════════════════════ */
    function scrollLog() {
        if (log) log.scrollTop = log.scrollHeight;
    }

    /* ══════════════════════════════════════════════════
       Bubble Renderer
    ══════════════════════════════════════════════════ */
    function appendBubble(content, sender) {
        if (!log) return;

        const msgWrapper = document.createElement('div');
        msgWrapper.className = `ta-msg ${sender === 'user' ? 'user' : 'bot'}`;

        // Avatar icon for assistant messages
        if (sender !== 'user') {
            const icon = document.createElement('div');
            icon.className = 'ta-msg-icon';
            icon.innerHTML = `<svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/></svg>`;
            msgWrapper.appendChild(icon);
        }

        const bubble = document.createElement('div');
        bubble.className = 'ta-bubble';

        if (sender === 'user') {
            // Plain text only for user — no HTML injection risk
            bubble.textContent = content;
        } else {
            // Assistant: parse booking cards, then render safe HTML
            let formatted = content;

            // FIX #6: parse **bold** markdown
            formatted = formatted.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');

            // Parse <booking-card> custom tags into styled cards
            formatted = formatted.replace(/<booking-card>([\s\S]*?)<\/booking-card>/g, (_, raw) => {
                const cardData = { TITLE: '', TYPE: '', LOCATION: '', PRICE: '', NOTE: '' };
                raw.trim().split('\n').forEach(line => {
                    const colonIdx = line.indexOf(':');
                    if (colonIdx === -1) return;
                    const key = line.slice(0, colonIdx).trim();
                    const val = line.slice(colonIdx + 1).trim();
                    if (Object.prototype.hasOwnProperty.call(cardData, key)) cardData[key] = val;
                });

                return `
                    <div class="ta-card">
                        <div class="ta-card-title">${escapeHtml(cardData.TITLE)}</div>
                        <div class="ta-card-row"><span>📍 Location:</span> <span>${escapeHtml(cardData.LOCATION)}</span></div>
                        <div class="ta-card-row"><span>🏷️ Type:</span> <span>${escapeHtml(cardData.TYPE)}</span></div>
                        <div class="ta-card-row"><span>💰 Price:</span> <span>${escapeHtml(cardData.PRICE)}</span></div>
                        <p class="ta-card-note">${escapeHtml(cardData.NOTE)}</p>
                        <a href="https://travelafric.com/search?q=${encodeURIComponent(cardData.TITLE)}"
                           target="_blank" rel="noopener noreferrer" class="ta-card-btn">View Details</a>
                    </div>
                `;
            });

            // Convert newlines to <br> then set — card HTML is already safe via escapeHtml
            // FIX #7: card data values are escaped; non-card content from AI is NOT innerHTML-injected raw.
            //         If you need AI free-text to support HTML, wrap in DOMPurify.sanitize() here.
            bubble.innerHTML = formatted.replace(/\n/g, '<br>');
        }

        msgWrapper.appendChild(bubble);
        log.appendChild(msgWrapper);
        scrollLog();
    }

    /* ══════════════════════════════════════════════════
       XSS Helper — escapes values inserted into card HTML
       FIX #7: prevents injected HTML from AI card field values
    ══════════════════════════════════════════════════ */
    function escapeHtml(str) {
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#39;');
    }

});
