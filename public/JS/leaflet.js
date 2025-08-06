document.addEventListener("DOMContentLoaded", function () {
    var map = L.map('map').setView([18.343612100434054, 121.63245382436055], 13);

    var layers = {
        "OpenStreetMap": L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: 'Municipal Government of Aparri © Elaurza 2025'
        }),
        "Esri World Imagery": L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            maxZoom: 19,
            attribution: 'Municipal Government of Aparri © Elaurza 2025'
        }),
        "OpenTopoMap": L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
            maxZoom: 17,
            attribution: 'Municipal Government of Aparri © Elaurza 2025'
        })
    };

    layers["OpenStreetMap"].addTo(map);
    L.control.layers(layers).addTo(map);

    var schools = [
        { name: "Aparri East Central School", lat: 18.3568573726796, lng: 121.64268494549377 },
        { name: "Aparri West Central School", lat: 18.310047707575116, lng: 121.60567296125184 }, // RED
        { name: "Aparri East National High School", lat: 18.353178238079497, lng: 121.65537645972182 }, // GREEN
        { name: "Cagayan State University - Aparri Campus", lat: 18.35201962875998, lng: 121.6501726184279 },
        { name: "San Antonio Elementary School", lat: 18.35914214759947, lng: 121.64072247329793 },
        { name: "Maura Elementary School", lat: 18.354779197128146, lng: 121.64831714050375 },
    ];

    var circles = [];

    schools.forEach(function (school, idx) {
        let color = '#0d6efd'; // Bootstrap Primary
        if (idx === 1) color = '#dc3545'; // Red
        else if (idx === 2) color = '#198754'; // Green

        let isRed = color === '#dc3545';

        let baseRadius = isRed ? 120 : 100;
        let rippleStart = isRed ? 250 : 100;
        let rippleMax = isRed ? 600 : 200;

        let baseCircle = L.circle([school.lat, school.lng], {
            color: '#ffffff',
            weight: 2,
            fillColor: color,
            fillOpacity: 0.8,
            radius: baseRadius,
            className: 'circle-shadow'
        }).addTo(map).bindPopup(school.name);

        let ripple = L.circle([school.lat, school.lng], {
            color: '#ffffff',
            weight: 1,
            fillColor: color,
            fillOpacity: 0.2,
            radius: rippleStart,
            interactive: false,
            className: 'circle-shadow'
        }).addTo(map);

        circles.push({
            base: baseCircle,
            ripple: ripple,
            isRed: isRed,
            rippleStart: rippleStart,
            rippleMax: rippleMax
        });
    });

    function animateCircle(c) {
        let currentOpacity = c.base.options.fillOpacity;
        c.base.setStyle({ fillOpacity: currentOpacity === 0.8 ? 0.2 : 0.8 });

        let steps = 20;
        let step = 0;
        let radius = c.rippleStart;

        let rippleInterval = setInterval(function () {
            radius += (c.rippleMax - c.rippleStart) / steps;
            let newOpacity = 0.2 * (1 - step / steps);
            c.ripple.setStyle({
                radius: radius,
                fillOpacity: newOpacity,
                opacity: newOpacity
            });
            step++;

            if (step >= steps) {
                c.ripple.setStyle({ radius: c.rippleStart, fillOpacity: 0.2, opacity: 0.2 });
                clearInterval(rippleInterval);
            }
        }, 30);
    }

    circles.forEach(function (c) {
        let intervalTime = c.isRed ? 600 : 1000;
        setInterval(function () {
            animateCircle(c);
        }, intervalTime);
    });

    window.setTerrain = function (type) {
        if (layers[type]) {
            map.eachLayer(function (layer) {
                if (layer instanceof L.TileLayer) {
                    map.removeLayer(layer);
                }
            });
            layers[type].addTo(map);
        }
    };
});