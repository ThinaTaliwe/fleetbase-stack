#!/usr/bin/env bash
set -e

SRC="/opt/fleetbase-stack/fleetbase/branding-work/bfrn-logo.svg"
PUBLIC="/opt/fleetbase-stack/fleetbase/console/public"
IMG_DIR="$PUBLIC/images"
FAV_DIR="$PUBLIC/favicon"

if [ ! -f "$SRC" ]; then
  echo "Source logo not found: $SRC"
  exit 1
fi

mkdir -p "$IMG_DIR" "$FAV_DIR"

echo "Generating main image assets..."
cp "$SRC" "$IMG_DIR/fleetbase-logo-svg.svg"
cp "$SRC" "$IMG_DIR/icon.svg"

inkscape "$SRC" -o "$IMG_DIR/icon.png" -w 512 -h 512

echo "Generating favicon PNGs..."
inkscape "$SRC" -o "$FAV_DIR/android-chrome-192x192.png" -w 192 -h 192
inkscape "$SRC" -o "$FAV_DIR/android-chrome-256x256.png" -w 256 -h 256

inkscape "$SRC" -o "$FAV_DIR/apple-touch-icon-57x57.png" -w 57 -h 57
inkscape "$SRC" -o "$FAV_DIR/apple-touch-icon-60x60.png" -w 60 -h 60
inkscape "$SRC" -o "$FAV_DIR/apple-touch-icon-72x72.png" -w 72 -h 72
inkscape "$SRC" -o "$FAV_DIR/apple-touch-icon-76x76.png" -w 76 -h 76
inkscape "$SRC" -o "$FAV_DIR/apple-touch-icon-114x114.png" -w 114 -h 114
inkscape "$SRC" -o "$FAV_DIR/apple-touch-icon-120x120.png" -w 120 -h 120
inkscape "$SRC" -o "$FAV_DIR/apple-touch-icon-144x144.png" -w 144 -h 144
inkscape "$SRC" -o "$FAV_DIR/apple-touch-icon-152x152.png" -w 152 -h 152
inkscape "$SRC" -o "$FAV_DIR/apple-touch-icon-180x180.png" -w 180 -h 180
inkscape "$SRC" -o "$FAV_DIR/apple-touch-icon.png" -w 180 -h 180

inkscape "$SRC" -o "$FAV_DIR/favicon-16x16.png" -w 16 -h 16
inkscape "$SRC" -o "$FAV_DIR/favicon-32x32.png" -w 32 -h 32
inkscape "$SRC" -o "$FAV_DIR/mstile-150x150.png" -w 150 -h 150

echo "Generating favicon.ico..."
convert "$FAV_DIR/favicon-16x16.png" "$FAV_DIR/favicon-32x32.png" "$FAV_DIR/favicon.ico"

echo "Generating safari pinned tab svg..."
cp "$SRC" "$FAV_DIR/safari-pinned-tab.svg"

echo "Writing browserconfig.xml..."
cat > "$FAV_DIR/browserconfig.xml" <<'EOF'
<?xml version="1.0" encoding="utf-8"?>
<browserconfig>
  <msapplication>
    <tile>
      <square150x150logo src="/favicon/mstile-150x150.png"/>
      <TileColor>#ffffff</TileColor>
    </tile>
  </msapplication>
</browserconfig>
EOF

echo "Writing site.webmanifest..."
cat > "$FAV_DIR/site.webmanifest" <<'EOF'
{
  "name": "BFRN",
  "short_name": "BFRN",
  "icons": [
    {
      "src": "/favicon/android-chrome-192x192.png",
      "sizes": "192x192",
      "type": "image/png"
    },
    {
      "src": "/favicon/android-chrome-256x256.png",
      "sizes": "256x256",
      "type": "image/png"
    }
  ],
  "theme_color": "#ffffff",
  "background_color": "#ffffff",
  "display": "standalone"
}
EOF

echo "Done."
