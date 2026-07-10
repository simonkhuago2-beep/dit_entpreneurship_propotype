<?php 
// Step out of ai_assist to safely include your custom database connection script
include_once __DIR__ . '/../cctech-admin/core/db_connect.php'; 

error_reporting(0);
ini_set('display_errors', 0);

// Grab your active database singleton wrapper instance
$conn = DB::getInstance();
?>

<button id="ta-trigger" aria-label="Open AI Travel Assistant" onclick="togglePanel()">
  <svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
  <span id="ta-badge">1</span>
</button>

<div id="ta-panel" role="dialog" aria-label="AI Travel Assistant">
  
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

  <div class="ta-chips">
    <button class="ta-chip" onclick="sendChip('Suggest hotels in Kenya')">🏨 Hotels</button>
    <button class="ta-chip" onclick="sendChip('Plan a 7-day Safari tour')">🦁 Safaris</button>
    <button class="ta-chip" onclick="sendChip('Beach excursions in Tanzania')">🏖️ Excursions</button>
    <button class="ta-chip" onclick="sendChip('Airport transfer options in Ghana')">🚗 Transfers</button>
  </div>

  <div id="ta-messages"></div>

  <div class="ta-input-area">
    <textarea id="ta-input" rows="1" placeholder="Ask me anything about your Africa trip…" 
      onkeydown="handleKey(event)" oninput="autoGrow(this)"></textarea>
    <button id="ta-send" onclick="sendMessage()" aria-label="Send">
      <svg viewBox="0 0 24 24"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
    </button>
  </div>
  <div class="ta-footer-note">Powered by Travelafric.com</div>
</div>

<!--<script src="widget.js" defer></script>-->