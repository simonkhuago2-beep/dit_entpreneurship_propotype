<?php
/**
 * widget.php
 * ─────────────────────────────────────────────────────────
 * The Travelafric AI Assistant widget.
 * Include this once on every page where you want the chat bubble:
 *
 *   <?php require_once '/path/to/widget.php'; ?>
 *
 * Place the require just before your closing </body> tag.
 * It outputs the HTML, a <link> for the CSS, and a <script> for the JS.
 *
 * The widget works on ANY page — homepage, hotel listings,
 * safari pages, checkout, etc. — without any extra configuration.
 */

// ── Safe Config Loading ──
// Default values (won't break if config is missing)
$widgetCssUrl = '/assets/css/widget.css';
$widgetJsUrl = '/assets/js/widget.js';
$widgetApiUrl = '/api/ai_assistant/endpoint.php';
$widgetUrl = '/assets/css/widget.css';

// Try to load config file safely - ONLY if it exists
$configFile = __DIR__ . '/config.php';
if (file_exists($configFile)) {
    require_once $configFile;
    
    // Use config values if defined
    if (defined('WIDGET_CSS_URL')) $widgetCssUrl = WIDGET_CSS_URL;
    if (defined('WIDGET_JS_URL')) $widgetJsUrl = WIDGET_JS_URL;
    if (defined('WIDGET_API_URL')) $widgetApiUrl = WIDGET_API_URL;
    if (defined('WIDGET_URL')) $widgetUrl = WIDGET_URL;
}

// For debugging - remove in production
// error_log('Widget: API URL = ' . $widgetApiUrl);
?>

<?php /* ── Stylesheet (injected once; browser caches it across pages) ── */ ?>
<link rel="stylesheet" href="<?= htmlspecialchars($widgetUrl, ENT_QUOTES, 'UTF-8') ?>">

<?php /* ════════════════════════════════════════════════════
         FLOATING TRIGGER BUTTON
       ════════════════════════════════════════════════════ */ ?>
<button id="ta-trigger" aria-label="Open AI Travel Assistant">
  <svg viewBox="0 0 24 24" aria-hidden="true">
    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
  </svg>
  <span id="ta-badge" aria-label="1 new message">1</span>
</button>

<?php /* ════════════════════════════════════════════════════
         CHAT PANEL
       ════════════════════════════════════════════════════ */ ?>
<div id="ta-panel" role="dialog" aria-modal="true" aria-label="AI Travel Assistant">

  <?php /* ── Header ── */ ?>
  <div class="ta-header">
    <div class="ta-avatar" aria-hidden="true">
      <svg viewBox="0 0 24 24">
        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
      </svg>
    </div>
    <div class="ta-header-text">
      <h3>Kwame – Your Travel Assistant</h3>
      <div class="ta-status">
        <span class="ta-status-dot" aria-hidden="true"></span>
        <p>Online · Plan trips, find hotels &amp; tours</p>
      </div>
    </div>
    <button class="ta-close" aria-label="Close assistant">&#x00D7;</button>
  </div>

  <?php /* ── Quick-action chips ── */ ?>
  <div class="ta-chips" role="list" aria-label="Quick actions">
    <button class="ta-chip" role="listitem" data-prompt="Suggest hotels in Kenya">🏨 Hotels</button>
    <button class="ta-chip" role="listitem" data-prompt="Plan a 7-day safari tour in Africa">🦁 Safaris</button>
    <button class="ta-chip" role="listitem" data-prompt="Beach excursions in Tanzania">🏖️ Excursions</button>
    <button class="ta-chip" role="listitem" data-prompt="Show all-inclusive packages in Africa">🌴 All Inclusive</button>
    <button class="ta-chip" role="listitem" data-prompt="Airport transfer options in Africa">🚗 Transfers</button>
    <button class="ta-chip" role="listitem" data-prompt="Car rental options in Africa">🚌 Rent-A-Car</button>
  </div>

  <?php /* ── Typing indicator (hidden by default, shown by JS) ── */ ?>
  <div id="ta-typing" style="display:none" aria-label="Kwame is typing" aria-live="polite">
    <span class="dot"></span>
    <span class="dot"></span>
    <span class="dot"></span>
  </div>

  <?php /* ── Message log ── */ ?>
  <div id="ta-messages"
       role="log"
       aria-live="polite"
       aria-label="Conversation"></div>

  <?php /* ── Input area ── */ ?>
  <div class="ta-input-area">
    <textarea
      id="ta-input"
      rows="1"
      placeholder="Ask me anything about your Africa trip…"
      aria-label="Type your message"
      aria-multiline="true"></textarea>
    <button id="ta-send" aria-label="Send message">
      <svg viewBox="0 0 24 24" aria-hidden="true">
        <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
      </svg>
    </button>
  </div>

  <p class="ta-footer-note">Powered by <a href="https://travelafric.com" target="_blank" rel="noopener">Travelafric.com</a></p>

</div>

<?php /* ── JS (deferred so it never blocks page render) ── */ ?>
<script>
  // Pass the API endpoint URL from PHP into the widget script
  // so widget.js never has the URL hardcoded.
  window.TA_API_URL = <?= json_encode($widgetApiUrl, JSON_UNESCAPED_SLASHES) ?>;
  
  // Debug - check if URL is set correctly (remove in production)
  console.log('🔧 Widget: API URL set to', window.TA_API_URL);
  
  // Safety check - if something went wrong, use fallback
  if (!window.TA_API_URL || window.TA_API_URL === 'WIDGET_API_URL') {
    window.TA_API_URL = '/api/ai_assistant/endpoint.php';
    console.warn('⚠️ Widget: Using fallback API URL', window.TA_API_URL);
  }
</script>
<script src="<?= htmlspecialchars($widgetJsUrl, ENT_QUOTES, 'UTF-8') ?>" defer></script>