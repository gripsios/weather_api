# 🌤️ Weather API

Εφαρμογή πρόγνωσης καιρού με PHP backend και jQuery frontend.  
Χρησιμοποιεί το [OpenWeatherMap API](https://openweathermap.org/api) για δεδομένα καιρού.

## Τεχνολογίες

- **Frontend:** HTML, CSS, jQuery
- **Backend:** PHP (XAMPP)
- **API:** OpenWeatherMap

## Δομή αρχείων

```
weather_api/
├── index.php          # Frontend (jQuery)
├── weather.php        # Backend API endpoint
├── config.php         # API key — ΔΕΝ ανεβαίνει στο GitHub
├── config.example.php # Πρότυπο για το config.php
└── .gitignore
```

## Εγκατάσταση

### 1. Κλωνοποίησε το repository
```bash
git clone https://github.com/YOUR_USERNAME/YOUR_REPO.git
cd APIs/weather_api
```

### 2. Δημιούργησε το config.php
```bash
cp config.example.php config.php
```
Άνοιξε το `config.php` και βάλε το API key σου:
```php
define('API_KEY', 'το_api_key_σου_εδώ');
```

> Το API key το παίρνεις δωρεάν από το [openweathermap.org](https://openweathermap.org) → API Keys.  
> ⚠️ Χρειάζεται έως 2 ώρες για να ενεργοποιηθεί ένα νέο key.

### 3. Τοποθέτηση στον XAMPP
Αντέγραψε τον φάκελο `weather_api` μέσα στο:
```
C:\xampp\htdocs\APIs\weather_api\
```

### 4. Άνοιξε τον browser
```
http://localhost/APIs/weather_api/
```

## Χρήση του API

Το `weather.php` λειτουργεί ως REST API endpoint:

```
GET weather.php?city=Thessaloniki
```

### Παράδειγμα απάντησης

```json
{
    "city": "Thessaloniki",
    "country": "GR",
    "temp": 24,
    "feels_like": 23,
    "humidity": 55,
    "wind_kmh": 18,
    "description": "αίθριος καιρός",
    "icon": "01d",
    "forecast": [
        { "date": "2026-05-17", "max": 25, "min": 18, "icon": "01d" },
        { "date": "2026-05-18", "max": 22, "min": 16, "icon": "10d" }
    ]
}
```