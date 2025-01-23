<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quantum Weather Nexus</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        :root {
            --bg-primary: #000c1a;
            --gradient-start: #1a2a6c;
            --gradient-middle: #b21f1f;
            --gradient-end: #fdbb2d;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-color: var(--bg-primary);
            overflow-x: hidden;
        }

        .animated-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-middle), var(--gradient-end));
            background-size: 400% 400%;
            animation: moveBackground 15s ease infinite;
            z-index: -1;
        }

        @keyframes moveBackground {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .glass-panel {
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.37);
        }

        .neon-title {
            color: #fff;
            text-shadow: 0 0 10px #00ffff, 0 0 20px #00ffff, 0 0 30px #00ffff;
            animation: neonGlow 2s infinite alternate;
        }

        @keyframes neonGlow {
            0% { text-shadow: 0 0 10px #00ffff; }
            100% { text-shadow: 0 0 30px #00ffff; }
        }

        .button {
            background-color: #00bcd4;
            color: #fff;
            padding: 1rem 2rem;
            border-radius: 5px;
            font-size: 1.2rem;
            border: none;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .button:hover {
            transform: scale(1.1);
            box-shadow: 0 0 15px #00bcd4;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            pointer-events: none;
            will-change: transform, opacity;
        }

        @keyframes floatParticles {
            0% { transform: translateY(0) scale(1); opacity: 0.5; }
            100% { transform: translateY(-100vh) scale(0.5); opacity: 0; }
        }
    </style>
</head>
<body>
    <!-- Background Animation -->
    <div class="animated-background"></div>

    <!-- Weather App -->
    <div class="container mx-auto px-4 py-20 text-center relative">
        <div class="max-w-2xl mx-auto glass-panel">
            <h1 class="text-4xl font-bold neon-title">Quantum Weather Nexus</h1>
            <form id="weatherForm" class="mt-8">
                <input 
                    type="text" 
                    id="city" 
                    name="city" 
                    placeholder="Enter a city" 
                    class="w-full p-4 rounded-lg bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4"
                    required
                >
                <button type="submit" class="button">Get Weather</button>
            </form>
            <div id="weatherResult" class="mt-8 hidden">
                <h2 class="text-2xl font-semibold text-white" id="cityName"></h2>
                <div class="mt-4 flex justify-center">
                    <img id="weatherIcon" alt="Weather Icon" class="w-24 h-24">
                    <div class="ml-6">
                        <p id="temperature" class="text-4xl font-bold text-white"></p>
                        <p id="condition" class="text-xl text-gray-300"></p>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 mt-6">
                    <div class="glass-panel p-4">
                        <p class="text-sm text-gray-400">Humidity</p>
                        <p id="humidity" class="text-2xl font-semibold text-white"></p>
                    </div>
                    <div class="glass-panel p-4">
                        <p class="text-sm text-gray-400">Wind Speed</p>
                        <p id="windSpeed" class="text-2xl font-semibold text-white"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        const apiKey = "b51e6f9c23954915988170927252301";

        // Handle form submission
        document.getElementById("weatherForm").addEventListener("submit", async function(event) {
            event.preventDefault();
            const city = document.getElementById("city").value;

            try {
                const response = await fetch(`https://api.weatherapi.com/v1/current.json?key=${apiKey}&q=${city}`);
                const data = await response.json();

                // Update UI with weather data
                document.getElementById("cityName").textContent = data.location.name;
                document.getElementById("weatherIcon").src = data.current.condition.icon;
                document.getElementById("temperature").textContent = `${data.current.temp_c}°C`;
                document.getElementById("condition").textContent = data.current.condition.text;
                document.getElementById("humidity").textContent = `${data.current.humidity}%`;
                document.getElementById("windSpeed").textContent = `${data.current.wind_kph} kph`;

                // Show weather result section
                document.getElementById("weatherResult").classList.remove("hidden");

            } catch (error) {
                alert("Could not fetch weather data. Please try again.");
            }
        });

        // Particle effects
        for (let i = 0; i < 100; i++) {
            const particle = document.createElement("div");
            particle.className = "particle";
            particle.style.width = `${Math.random() * 10}px`;
            particle.style.height = particle.style.width;
            particle.style.left = `${Math.random() * 100}%`;
            particle.style.top = `${Math.random() * 100}%`;
            particle.style.animation = `floatParticles ${15 + Math.random() * 10}s infinite`;
            document.body.appendChild(particle);
        }
    </script>
</body>
</html>
