<?php include "cctech-admin/core/init.php"; 
error_reporting(0);
    $conn = DB::getInstance();
?>

<!-- ── FLOATING TRIGGER ── -->
<button id="ta-trigger" aria-label="Open AI Travel Assistant" onclick="togglePanel()">
  <svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
  <span id="ta-badge">1</span>
</button>

<!-- ── CHAT PANEL ── -->
<div id="ta-panel" role="dialog" aria-label="AI Travel Assistant">
  
  <!-- Header -->
  <div class="ta-header">
    <div class="ta-avatar">
      <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/></svg>
    </div>
    <div class="ta-header-text">
      <h3>Kwame – Your Travel Assistant</h3>
      <div class="ta-status">
        <span class="ta-status-dot"></span>
        <p>Online · Plan trips, find hotels & tours</p>
      </div>
    </div>
    <button class="ta-close" onclick="togglePanel()" aria-label="Close">×</button>
  </div>

  <!-- Quick-action chips -->
  <div class="ta-chips">
    <button class="ta-chip" onclick="sendChip('Suggest hotels in Kenya')">🏨 Hotels</button>
    <button class="ta-chip" onclick="sendChip('Plan a 7-day Safari tour')">🦁 Safaris</button>
    <button class="ta-chip" onclick="sendChip('Beach excursions in Tanzania')">🏖️ Excursions</button>
    <button class="ta-chip" onclick="sendChip('Airport transfer options in Ghana')">🚗 Transfers</button>
  </div>

  <!-- Messages -->
  <div id="ta-messages">
    <!-- Greeting injected by JS -->
  </div>

  <!-- Input -->
  <div class="ta-input-area">
    <textarea id="ta-input" rows="1" placeholder="Ask me anything about your Africa trip…" 
      onkeydown="handleKey(event)" oninput="autoGrow(this)"></textarea>
    <button id="ta-send" onclick="sendMessage()" aria-label="Send">
      <svg viewBox="0 0 24 24"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
    </button>
  </div>
  <div class="ta-footer-note">Powered by Travelafric.com</div>
</div>

<script>
    // Fetch a response from the AI backend
    fetch('api/ai_chat/chat.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json(); 
        })
        .then(data => {
            console.log('Success:', data);
            
            // 1. Target your messages container
            const messagesContainer = document.getElementById('ta-messages');
            
            // 2. Extract the text reply (Assumes your PHP returns JSON like: {"reply": "Your AI text..."})
            const aiReply = data.reply; 
            
            // 3. Create a clean HTML structure for the incoming message bubble
            const messageHtml = `
                <div class="ta-message ta-message-received">
                    <div class="ta-message-content">
                        ${aiReply}
                    </div>
                </div>
            `;
            
            // 4. Append the new message bubble to the container
            messagesContainer.insertAdjacentHTML('beforeend', messageHtml);
            
            // 5. Automatically scroll to the bottom of the container so the user sees the response
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        })
        .catch(error => {
            console.error('Fetch error:', error);
            
            // Optional: Show a user-friendly error inside the chat UI
            const messagesContainer = document.getElementById('ta-messages');
            messagesContainer.insertAdjacentHTML('beforeend', `
                <div class="ta-message ta-message-error">
                    <div class="ta-message-content" style="color: red;">
                        ⚠️ Sorry, I'm having trouble connecting right now. Please try again.
                    </div>
                </div>
            `);
        });
</script>
