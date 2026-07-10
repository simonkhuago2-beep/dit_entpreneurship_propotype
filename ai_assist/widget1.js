/* ══════════════════════════════════════════════════
   State, Configuration & Memory Management
══════════════════════════════════════════════════ */
let panelOpen = false;
const history = []; // Holds sequential tracking arrays {role, content} for the OpenAI API thread

/* ══════════════════════════════════════════════════
   Panel Toggle (Matches id="ta-panel", id="ta-trigger", id="ta-badge")
══════════════════════════════════════════════════ */
function togglePanel() {
  panelOpen = !panelOpen;
  
  const panel = document.getElementById('ta-panel');
  if (panel) {
    panel.classList.toggle('open', panelOpen);
  }
  
  const badge = document.getElementById('ta-badge');
  if (badge) {
    badge.style.display = panelOpen ? 'none' : 'inline-block';
  }

  if (panelOpen) {
    const input = document.getElementById('ta-input');
    if (input) {
      input.focus();
    }
    if (history.length === 0) {
      addGreeting();
    }
  }
}

/* ══════════════════════════════════════════════════
   Greeting Generation
══════════════════════════════════════════════════ */
function addGreeting() {
  const hour = new Date().getHours();
  const greet = hour < 12 ? 'Good morning' : hour < 17 ? 'Good afternoon' : 'Good evening';
  
  addBotMessage(`${greet}! 👋 I'm **Kwame**, your personal Africa travel assistant.\n\nTell me where you'd like to go, what kind of experience you're looking for, or pick a quick option above — and I'll help you plan the perfect trip! 🌍`);
}

/* ══════════════════════════════════════════════════
   Chip Click Handler (Matches onclick="sendChip('...')")
══════════════════════════════════════════════════ */
function sendChip(text) {
  const input = document.getElementById('ta-input');
  if (input) {
    input.value = text;
    sendMessage(); 
  }
}

/* ══════════════════════════════════════════════════
   Send Message Pipeline (Matches onclick="sendMessage()")
══════════════════════════════════════════════════ */
async function sendMessage() {
  const input = document.getElementById('ta-input');
  if (!input) return;

  const text = input.value.trim();
  if (!text) return;

  // 1. Render user's message bubble locally on the screen
  addUserMessage(text);
  input.value = '';
  input.style.height = 'auto'; 

  // 2. Track persistent conversation history context arrays
  history.push({ role: 'user', content: text });

  // 3. Initialize visual typing indicator animation bubble
  const typingId = showTyping();

  // 4. Temporarily disable button to safeguard against double clicking submissions
  const sendBtn = document.getElementById('ta-send');
  if (sendBtn) sendBtn.disabled = true;

  try {
    // 5. Query your absolute relative folder path location to find your standalone PHP API
    const response = await fetch('../api/ai_assistant/chat.php', { 
      method: 'POST',
      headers: { 
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        messages: history 
      })
    });

    if (!response.ok) {
        throw new Error(`Server returned error response status code: ${response.status}`);
    }

    const data = await response.json();
    const reply = data.reply || "I'm sorry, I couldn't get a clear response. Please try again.";

    // 6. Push assistant response to local session memory array loop
    history.push({ role: 'assistant', content: reply });

    // 7. Clean up typing indicator and paint response layers onto the DOM
    removeTyping(typingId);
    renderBotReply(reply);

  } catch (err) {
    console.error("Communication API pipeline error details:", err);
    removeTyping(typingId);
    addBotMessage("Oops! I'm having trouble connecting right now. Please check your internet and try again. 🙏");
  } finally {
    if (sendBtn) sendBtn.disabled = false;
    input.focus();
  }
}

/* ══════════════════════════════════════════════════
   Render Engine & Custom Booking Card Parsers
══════════════════════════════════════════════════ */
function renderBotReply(text) {
  const parts = text.split(/<booking-card>([\s\S]*?)<\/booking-card>/g);
  let textAccum = '';

  parts.forEach((part, i) => {
    if (i % 2 === 0) {
      textAccum += part;
    } else {
      if (textAccum.trim()) { 
        addBotMessage(textAccum.trim()); 
        textAccum = ''; 
      }
      addBookingCard(parseCard(part));
    }
  });
  
  if (textAccum.trim()) {
    addBotMessage(textAccum.trim());
  }
}

function parseCard(raw) {
  const get = (key) => {
    const m = raw.match(new RegExp(key + ':\\s*(.+)'));
    return m ? m[1].trim() : '';
  };
  return {
    title: get('TITLE'),
    type: get('TYPE'),
    location: get('LOCATION'),
    price: get('PRICE'),
    note: get('NOTE')
  };
}

function addBookingCard(card) {
  const msgs = document.getElementById('ta-messages');
  if (!msgs) return;

  const wrap = document.createElement('div');
  // Matched perfectly with your parent container structure styles (.ta-msg .bot)
  wrap.className = 'ta-msg bot'; 
  wrap.innerHTML = `
    <div class="ta-msg-icon">
      <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/></svg>
    </div>
    <div class="ta-card">
      <div class="ta-card-title">${escHtml(card.title)}</div>
      <div class="ta-card-row"><span>📍 Location:</span> <span>${escHtml(card.location)}</span></div>
      <div class="ta-card-row"><span>🏷️ Type:</span> <span>${escHtml(card.type)}</span></div>
      <div class="ta-card-row"><span>💰 Price:</span> <span>${escHtml(card.price)}</span></div>
      <p style="font-size:12px; color:#666; margin:8px 0 12px 0; line-height:1.4; font-style: italic;">${escHtml(card.note)}</p>
      <button class="ta-card-btn" onclick="bookNow('${escHtml(card.type)}', '${escHtml(card.location)}')">Book Now →</button>
    </div>`;
    
  msgs.appendChild(wrap);
  msgs.scrollTop = msgs.scrollHeight;
}

function bookNow(type, location) {
  const country = location.split(',').pop().trim();
  sendChip(`I want to book a ${type} in ${country}. What details do I need?`);
}

/* ══════════════════════════════════════════════════
   UI Layout DOM Injection Helpers
══════════════════════════════════════════════════ */
function addUserMessage(text) {
  const msgs = document.getElementById('ta-messages');
  if (!msgs) return;

  const wrap = document.createElement('div');
  // Matched perfectly with your stylesheet layouts (.ta-msg .user)
  wrap.className = 'ta-msg user'; 
  wrap.innerHTML = `<div class="ta-bubble">${escHtml(text)}</div>`;
  
  msgs.appendChild(wrap);
  msgs.scrollTop = msgs.scrollHeight;
}

function addBotMessage(text) {
  const msgs = document.getElementById('ta-messages');
  if (!msgs) return;

  const wrap = document.createElement('div');
  // Matched perfectly with your stylesheet layouts (.ta-msg .bot)
  wrap.className = 'ta-msg bot'; 
  
  const html = escHtml(text)
    .replace(/\*\*(.+?)\*\*/g, '<strong>$1</strong>')
    .replace(/\n/g, '<br>');
    
  wrap.innerHTML = `
    <div class="ta-msg-icon">
      <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/></svg>
    </div>
    <div class="ta-bubble">${html}</div>`;
  
  msgs.appendChild(wrap);
  msgs.scrollTop = msgs.scrollHeight;
}

function showTyping() {
  const msgs = document.getElementById('ta-messages');
  if (!msgs) return null;

  const id = 'typing-' + Date.now();
  const wrap = document.createElement('div');
  wrap.className = 'ta-msg bot'; 
  wrap.id = id;
  // Plucked from your style sheets (.ta-typing span) to drive the bouncing balls!
  wrap.innerHTML = `
    <div class="ta-msg-icon">
      <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/></svg>
    </div>
    <div class="ta-bubble">
      <div class="ta-typing">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>`;
  
  msgs.appendChild(wrap);
  msgs.scrollTop = msgs.scrollHeight;
  return id;
}

function removeTyping(id) {
  const el = document.getElementById(id);
  if (el) el.remove();
}

/* ══════════════════════════════════════════════════
   Utilities & Keyboard Listeners
══════════════════════════════════════════════════ */
function escHtml(s) {
  return (s || '').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
}

function handleKey(e) {
  if (e.key === 'Enter' && !e.shiftKey) { 
    e.preventDefault(); 
    sendMessage(); 
  }
}

function autoGrow(el) {
  el.style.height = 'auto';
  el.style.height = Math.min(el.scrollHeight, 100) + 'px'; // Maxes out right at your CSS 100px mark
}