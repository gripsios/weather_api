<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Πρόγνωση Καιρού</title>
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css" />
    <script src="jquery_css.js"></script>
</head>
<body>
    <div class="app">
        <h1>🌤️ Πρόγνωση Καιρού</h1>

        <div class="search-bar">
            <input type="text" id="city-input" placeholder="Αναζήτηση πόλης... (π.χ. Thessaloniki)" />
            <button class="btn" id="search-btn">Αναζήτηση</button>
        </div>

        <div id="error-msg" class="error" style="display:none"></div>
        <div id="loading" class="loading" style="display:none">⏳ Φόρτωση...</div>

        <div id="weather-section">
            <div class="weather-card">
                <div class="city-name" id="city-display"></div>
                <div class="country" id="country-display"></div>
                <div class="main-temp">
                <div>
                    <div class="temp-big" id="temp-display"></div>
                    <div class="weather-desc" id="desc-display"></div>
                </div>
                <div class="weather-icon" id="icon-display"></div>
                </div>
                <div class="stats-grid">
                <div class="stat">
                    <div class="stat-label">💧 Υγρασία</div>
                    <div class="stat-value" id="humidity-display"></div>
                </div>
                <div class="stat">
                    <div class="stat-label">💨 Άνεμος</div>
                    <div class="stat-value" id="wind-display"></div>
                </div>
                <div class="stat">
                    <div class="stat-label">🌡️ Αίσθηση</div>
                    <div class="stat-value" id="feels-display"></div>
                </div>
                </div>
            </div>

            <div class="section-title">5ήμερη πρόγνωση</div>
            <div class="forecast-grid" id="forecast-grid"></div>
        </div>
    </div>
</body>
</html>