document.addEventListener("DOMContentLoaded", function() {
            var map = L.map('map').setView([18.354916650824126, 121.64484737387285], 16); // Aparri, Cagayan

            // Tile layers
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

            // Add default layer
            layers["OpenStreetMap"].addTo(map);

            // Add layer control
            L.control.layers(layers).addTo(map);

            // List of schools in Aparri, Cagayan (sample coordinates)
            var schools = [
                { name: "Aparri East Central School", lat: 18.3568573726796, lng: 121.64268494549377 },
                { name: "Aparri West Central School", lat: 18.310047707575116, lng: 121.60567296125184 },
                { name: "Aparri East National High School", lat: 18.353178238079497, lng: 121.65537645972182 },
                { name: "Cagayan State University - Aparri Campus", lat: 18.35201962875998, lng: 121.6501726184279 },
                { name: "San Antonio Elementary School", lat: 18.35914214759947, lng: 121.64072247329793 },
                { name: "Maura Elementary School", lat: 18.354779197128146, lng: 121.64831714050375 },
            ];

            // Define custom marker icons for red and green
            var redIcon = new L.Icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });

            var greenIcon = new L.Icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-green.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });

            // First marker default (blue), second red, third green, rest blue
            schools.forEach(function(school, idx) {
                let icon = undefined;
                if (idx === 1) icon = redIcon;
                else if (idx === 2) icon = greenIcon;
                L.marker([school.lat, school.lng], icon ? { icon: icon } : undefined).addTo(map)
                .bindPopup(school.name);
            });

            // Function to set terrain
            window.setTerrain = function(type) {
                if (layers[type]) {
                map.eachLayer(function(layer) {
                    if (layer instanceof L.TileLayer) {
                    map.removeLayer(layer);
                    }
                });
                layers[type].addTo(map);
                }
            };
            });