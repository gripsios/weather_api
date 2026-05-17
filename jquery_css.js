const weatherIcons = {
    '01d':'☀️','01n':'🌙',
    '02d':'⛅','02n':'⛅',
    '03d':'☁️','03n':'☁️',
    '04d':'☁️','04n':'☁️',
    '09d':'🌧️','09n':'🌧️',
    '10d':'🌦️','10n':'🌧️',
    '11d':'⛈️','11n':'⛈️',
    '13d':'❄️','13n':'❄️',
    '50d':'🌫️','50n':'🌫️',
};

const dayNames = ['Κυρ','Δευ','Τρι','Τετ','Πεμ','Παρ','Σαβ'];

function showError(msg) {
    $('#error-msg').text('⚠️ ' + msg).show();
}

function fetchWeather() {
    const city = $('#city-input').val().trim();
    $('#error-msg').hide();
    $('#weather-section').hide();

    if (!city) { showError('Παρακαλώ γράψε μια πόλη!'); return; }

    $('#loading').show();

    $.ajax({
        url: 'weather.php',           // κλήση στο δικό μας PHP API
        data: { 
            city: city 
        },
        dataType: 'json',
        success: function(data) {
            $('#loading').hide();

            if (data.error) { showError(data.error); return; }

            $('#city-display').text(data.city);
            $('#country-display').text(data.country);
            $('#temp-display').text(data.temp + '°C');
            $('#desc-display').text(data.description);
            $('#icon-display').text(weatherIcons[data.icon] || '🌡️');
            $('#humidity-display').text(data.humidity + '%');
            $('#wind-display').text(data.wind_kmh + ' km/h');
            $('#feels-display').text(data.feels_like + '°C');

            $('#forecast-grid').empty();
            $.each(data.forecast, function(i, d) {
                const dayName = dayNames[new Date(d.date).getDay()];
                const icon    = weatherIcons[d.icon] || '🌡️';
                $('#forecast-grid').append(`
                <div class="forecast-day">
                    <div class="forecast-day-name">${dayName}</div>
                    <div class="forecast-icon">${icon}</div>
                    <div class="forecast-temp">${d.max}°</div>
                    <div class="forecast-min">${d.min}°</div>
                </div>`);
            });

            $('#weather-section').show();
        },
        error: function(xhr) {
            $('#loading').hide();
            const msg = xhr.responseJSON && xhr.responseJSON.error;
            if (msg === 'city not found') {
                showError('Η πόλη δεν βρέθηκε. Δοκίμασε στα αγγλικά (π.χ. Thessaloniki).');
            } else {
                showError(msg || 'Κάτι πήγε στραβά. Έλεγξε το API key στο weather.php.');
            }
        }
    });
}

$(document).ready(function() {
    $('#search-btn').on('click', fetchWeather);
    $('#city-input').on('keydown', function(e) {
        if (e.key === 'Enter') fetchWeather();
    });
});