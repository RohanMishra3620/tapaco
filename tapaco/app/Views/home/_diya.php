<svg width="150" height="150" viewBox="0 0 150 150" fill="none" xmlns="http://www.w3.org/2000/svg" style="position:relative;z-index:1;overflow:visible">
  <defs>
    <radialGradient id="dyFlame" cx="50%" cy="32%" r="62%">
      <stop offset="0%"  stop-color="#FFFBE6"/>
      <stop offset="30%" stop-color="#FFD250"/>
      <stop offset="64%" stop-color="#F5930E"/>
      <stop offset="100%" stop-color="#D9540A"/>
    </radialGradient>
    <linearGradient id="dyBrass" x1="0" y1="0" x2="0" y2="1">
      <stop offset="0%"  stop-color="#F0C45C"/>
      <stop offset="42%" stop-color="#C68F12"/>
      <stop offset="100%" stop-color="#8A5E08"/>
    </linearGradient>
    <linearGradient id="dyBrassTop" x1="0" y1="0" x2="0" y2="1">
      <stop offset="0%"  stop-color="#FBE6A6"/>
      <stop offset="100%" stop-color="#D2A024"/>
    </linearGradient>
  </defs>

  <!-- flame (flickers from wick) -->
  <g style="transform-origin:75px 78px;animation:flicker 1.05s ease-in-out infinite">
    <!-- soft outer glow -->
    <path d="M75 14 C75 14 101 44 101 78 C101 98 89 112 75 112 C61 112 49 98 49 78 C49 44 75 14 75 14Z" fill="url(#dyFlame)" opacity=".4"/>
    <!-- flame body -->
    <path d="M75 24 C75 24 95 48 95 78 C95 95 86 106 75 106 C64 106 55 95 55 78 C55 48 75 24 75 24Z" fill="url(#dyFlame)"/>
    <!-- bright core -->
    <path d="M75 50 C75 50 85 63 85 79 C85 89 81 97 75 97 C69 97 65 89 65 79 C65 63 75 50 75 50Z" fill="#FFF4C2"/>
    <!-- hot white center -->
    <ellipse cx="75" cy="84" rx="5.5" ry="11" fill="#FFFDF2"/>
  </g>

  <!-- wick -->
  <rect x="73" y="104" width="4" height="12" rx="1.5" fill="#5A3A1A"/>

  <!-- brass diya bowl (traditional dish with pointed front lip) -->
  <ellipse cx="75" cy="118" rx="50" ry="11" fill="#7A4E06" opacity=".22"/>
  <!-- back rim highlight -->
  <path d="M27 116 Q75 104 123 116" stroke="url(#dyBrassTop)" stroke-width="5" fill="none" stroke-linecap="round"/>
  <!-- bowl body -->
  <path d="M26 116 Q40 126 75 127 Q120 128 138 116 Q132 138 75 140 Q24 138 26 116Z" fill="url(#dyBrass)"/>
  <!-- pointed wick lip (front spout) -->
  <path d="M118 117 Q132 112 142 110 Q134 122 124 124 Z" fill="url(#dyBrass)"/>
  <!-- decorative band -->
  <path d="M30 122 Q75 134 120 122" stroke="#FFE9A8" stroke-width="1.6" fill="none" opacity=".7"/>
  <!-- foot base -->
  <ellipse cx="75" cy="140" rx="20" ry="4" fill="#7A5208"/>
</svg>
