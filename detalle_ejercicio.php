<?php
session_start();

// Capturar el código de la rutina desde la URL
$planId = $_GET['code'] ?? $_GET['id'] ?? 'EX-G1-01';
$planId = strtoupper(trim($planId));

// Base de Datos Centralizada de Rutinas de Ejercicio con Videos Universales y Herramientas Variadas
$planes = [
    // ---------------- VERDES: CONDITIONING AND MOBILITY ----------------
    'EX-G1-01' => [
        'title' => 'Full Body Starter Routine',
        'category' => 'Conditioning and Mobility Routines',
        'badge_class' => 'badge-green',
        'image' => 'img/piernas_superior.png',
        'target' => 'Quadriceps, Core, Upper Back, Shoulders',
        'duration' => '30 min/day',
        'frequency' => '3x / Weekly',
        'summary' => 'Low-impact progressive movements to activate core strength, improve joint flexibility, and build daily functional mobility.',
        'tool_title' => 'Interactive Rest & Set Interval Timer',
        'tool_desc' => 'Time your rest periods strictly (45 seconds) between sets to maximize cardiovascular efficiency.',
        'tool_btn' => 'Start Interval Timer',
        'tool_type' => 'interval',
        'timeline' => [
            ['time' => 'Warm-up (5 min)', 'action' => 'Dynamic Joint Mobility Routine', 'desc' => 'Arm circles, leg swings, and thoracic rotations to lubricate joints and increase heart rate.'],
            ['time' => 'Block 1 (10 min)', 'action' => '<a href="#" class="breathing-link" onclick="openVideoModal(\'https://www.youtube.com/embed/aclHkTP74hE\', event)">Bodyweight Squats & Core Activation</a>', 'desc' => '3 sets of 12 bodyweight squats paired with 30-second plank holds.'],
            ['time' => 'Block 2 (10 min)', 'action' => '<a href="#" class="breathing-link" onclick="openVideoModal(\'https://www.youtube.com/embed/sSBYB1O9-Sg\', event)">Wall Push-ups & Band Incline Rows</a>', 'desc' => '3 sets of 10-12 wall push-ups to protect shoulder joints while strengthening chest.'],
            ['time' => 'Cool-down (5 min)', 'action' => 'Static Full-Body Decompression Stretch', 'desc' => 'Hold hamstrings, hip flexors, and chest stretches for 20-30 seconds each.']
        ],
        'checklist' => [
            'Completed 5-minute dynamic warm-up',
            'Maintained steady breathing control during squats',
            'Completed all 3 core stabilization sets',
            'Finished 5-minute static cooling stretch'
        ]
    ],
    'EX-G2-01' => [
        'title' => 'Active Toning and Core',
        'category' => 'Conditioning and Mobility Routines',
        'badge_class' => 'badge-green',
        'image' => 'img/cuadritos.png',
        'target' => 'Abs, Glutes, Hamstrings, Lower Back',
        'duration' => '45 min/day',
        'frequency' => '4x / Weekly',
        'summary' => 'Progressive resistance training focused on functional stability, posterior chain recruitment, and deep abdominal wall strengthening.',
        'tool_title' => 'Core Plank & Tension Hold Timer',
        'tool_desc' => 'Hold isometric contractions for 60-second intervals to maximize core motor unit firing.',
        'tool_btn' => 'Start Plank Timer',
        'tool_type' => 'plank',
        'timeline' => [
            ['time' => 'Warm-up (7 min)', 'action' => 'Pelvic Tilt & Cat-Cow Mobilization', 'desc' => 'Activate deep transverse abdominis and release lower back stiffness.'],
            ['time' => 'Block 1 (15 min)', 'action' => '<a href="#" class="breathing-link" onclick="openVideoModal(\'https://www.youtube.com/embed/wPM8icPu6H8\', event)">Glute Bridges & Bird-Dog Sequence</a>', 'desc' => '4 sets of 15 glute bridges focusing on full contraction at top.'],
            ['time' => 'Block 2 (15 min)', 'action' => '<a href="#" class="breathing-link" onclick="openVideoModal(\'https://www.youtube.com/embed/g_tea8ZNk5A\', event)">Abdominal Hollow Holds & Deadbugs</a>', 'desc' => '3 sets of 45-second isometric hollow body holds.'],
            ['time' => 'Cool-down (8 min)', 'action' => 'Cobra Stretch & Child Position', 'desc' => 'Deep abdominal wall lengthening and lumbar release.']
        ],
        'checklist' => [
            'Sustained anterior core pelvic engagement',
            'Completed 4 sets of focused glute bridging',
            'No lower back strain experienced during planks',
            'Finished spinal extension cool-down'
        ]
    ],
    'EX-G1-02' => [
        'title' => 'Joint Protection & Low Impact',
        'category' => 'Conditioning and Mobility Routines',
        'badge_class' => 'badge-green',
        'image' => 'img/pantorrilla.png',
        'target' => 'Legs, Glutes, Calves, Light Cardio',
        'duration' => '35 min/day',
        'frequency' => '3x / Weekly',
        'summary' => 'Gentle calorie-burning exercises specifically structured to safeguard knee and hip cartilage while boosting circulation.',
        'tool_title' => 'Visual Rhythm & Movement Cadence',
        'tool_desc' => 'Follow the visual pulse guide to maintain steady Zone 2 pacing without over-exerting your joints.',
        'tool_btn' => 'Start Pacing Cadence',
        'tool_type' => 'cadence',
        'timeline' => [
            ['time' => 'Warm-up (5 min)', 'action' => 'Ankle Mobility & Seated Leg Extensions', 'desc' => 'Lubricate lower limb kinetic chain without weight load.'],
            ['time' => 'Block 1 (12 min)', 'action' => '<a href="#" class="breathing-link" onclick="openVideoModal(\'https://www.youtube.com/embed/UXJrBgI2M6M\', event)">Supported Chair Squats & Calf Raises</a>', 'desc' => '3 sets of 12 seated-to-standing transfers using a sturdy chair for support.'],
            ['time' => 'Block 2 (12 min)', 'action' => '<a href="#" class="breathing-link" onclick="openVideoModal(\'https://www.youtube.com/embed/gC_L9qAHVJ8\', event)">Standing Side Marching & Arm Driver</a>', 'desc' => 'Low-impact steady state cardio continuous rhythm.'],
            ['time' => 'Cool-down (6 min)', 'action' => 'Calf & Quadriceps Wall Stretch', 'desc' => 'Gentle hamstring and soleus lengthening.']
        ],
        'checklist' => [
            'Used chair support for zero-pain squats',
            'Maintained continuous Zone 2 breathing pace',
            'Kept impact strictly at zero throughout session',
            'Completed full lower body static stretching'
        ]
    ],

    // ---------------- NARANJAS: SPECIFIC CONDITIONS ----------------
    'EX-C1-01' => [
        'title' => 'Walking and Glycemic Endurance',
        'category' => 'Plans for Specific Conditions',
        'badge_class' => 'badge-orange',
        'image' => 'img/biceps.png',
        'target' => 'Calves, Hamstrings, Biceps, Core',
        'duration' => '30 min/day',
        'frequency' => '5x / Weekly',
        'summary' => 'Structured low-resistance cardiovascular and muscular routines to enhance GLUT-4 translocation and optimize postprandial glucose uptake.',
        'tool_title' => 'Post-Meal Glycemic Walk Timer',
        'tool_desc' => 'Timed steady walking session executed within 30 minutes following main meals to blunt blood sugar spikes.',
        'tool_btn' => 'Start Walk Timer',
        'tool_type' => 'interval',
        'timeline' => [
            ['time' => 'Pre-Session Check', 'action' => 'Hydration & Baseline Check', 'desc' => 'Ensure proper hydration and comfortable footwear before starting.'],
            ['time' => 'Active Phase (20 min)', 'action' => '<a href="#" class="breathing-link" onclick="openVideoModal(\'https://www.youtube.com/embed/enYITYwvPAQ\', event)">Interval Walk & Light Resistance Curl</a>', 'desc' => 'Brisk walking alternated with light 1kg dumbbell/band bicep curls.'],
            ['time' => 'Cool-down (10 min)', 'action' => 'Slow Stride & Breathing Stabilization', 'desc' => 'Gradually reduce pace to baseline resting heart rate.']
        ],
        'checklist' => [
            'Checked footwear and performed ankle flexes',
            'Completed 20 minutes continuous glycemic walking',
            'Hydrated with plain water during rest intervals',
            'Noticed steady energy with no lightheadedness'
        ]
    ],
    'EX-C1-02' => [
        'title' => 'Controlled Cardiovascular Flow',
        'category' => 'Plans for Specific Conditions',
        'badge_class' => 'badge-orange',
        'image' => 'img/gluteos.png',
        'target' => 'Cardiovascular System, Core, Glutes',
        'duration' => '30 min/day',
        'frequency' => '4x / Weekly',
        'summary' => 'Continuous moderate-intensity aerobic flow designed to decrease peripheral vascular resistance and safely support arterial circulation.',
        'tool_title' => 'Aerobic Pace Cadence Guide',
        'tool_desc' => 'Pacing guide to keep your pulse steady and effort level below RPE 5 (conversational level).',
        'tool_btn' => 'Start Pacing Guide',
        'tool_type' => 'cadence',
        'timeline' => [
            ['time' => 'Warm-up (5 min)', 'action' => 'Diaphragmatic Breathing & Slow March', 'desc' => 'Prevents sudden blood pressure spikes by initiating smooth blood flow.'],
            ['time' => 'Main Flow (20 min)', 'action' => '<a href="#" class="breathing-link" onclick="openVideoModal(\'https://www.youtube.com/embed/gC_L9qAHVJ8\', event)">Low-Intensity Aerobic Flow</a>', 'desc' => 'Rhythmic stepping, glute kickbacks, and low-range arm extensions.'],
            ['time' => 'Cool-down (5 min)', 'action' => 'Gradual Deceleration', 'desc' => 'Slow walking to avoid blood pooling in extremities.']
        ],
        'checklist' => [
            'Avoided holding breath during movements (Valsalva control)',
            'Maintained steady conversational breathing pace',
            'Monitored effort level below RPE 5',
            'Completed gradual cool-down without abrupt stops'
        ]
    ],

    // ---------------- ROJOS: ADVANCED TRAINING ----------------
    'EX-A3-01' => [
        'title' => 'Hypertrophy and Muscle Strength',
        'category' => 'Advanced Training & Intensity',
        'badge_class' => 'badge-red',
        'image' => 'img/pecho.png',
        'target' => 'Chest, Deltoids, Triceps, Back, Biceps',
        'duration' => '60 min/day',
        'frequency' => '5x / Weekly',
        'summary' => 'High-volume periodized resistance routine focused on progressive overload, mechanical tension, and maximal muscle tissue hypertrophy.',
        'tool_title' => 'Interactive Rep & Set Counter',
        'tool_desc' => 'Track your completed reps and sets step-by-step during working resistance sets.',
        'tool_btn' => 'Launch Rep Tracker',
        'tool_type' => 'rep_counter',
        'timeline' => [
            ['time' => 'Warm-up (10 min)', 'action' => 'Rotator Cuff & Movement Specific Prep', 'desc' => 'Band pull-aparts, light warm-up sets building to working weight.'],
            ['time' => 'Primary Compound (20 min)', 'action' => '<a href="#" class="breathing-link" onclick="openVideoModal(\'https://www.youtube.com/embed/rT7DgCr-3pg\', event)">Heavy Incline Press & Barbell Rows</a>', 'desc' => '4 sets of 8-10 reps at RIR 2 (Reps in Reserve).'],
            ['time' => 'Accessory Isolation (20 min)', 'action' => '<a href="#" class="breathing-link" onclick="openVideoModal(\'https://www.youtube.com/embed/vB5OHsJ3EME\', event)">Lateral Raises & Triceps Extensions</a>', 'desc' => '3 sets of 12-15 reps focusing on peak contraction.'],
            ['time' => 'Cool-down (10 min)', 'action' => 'Fascial Stretching & Myofascial Release', 'desc' => 'Deep chest doorframe stretches and lat lengthening.']
        ],
        'checklist' => [
            'Logged working weight loads for progressive overload',
            'Rested at least 90 seconds between heavy compound sets',
            'Maintained proper execution form near muscular failure',
            'Completed post-workout stretch protocol'
        ]
    ]
];

// Obtener datos del ejercicio o fallback
$plan = $planes[$planId] ?? $planes['EX-G1-01'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($plan['title']) ?> - Nutrition Express</title>
    
    <link rel="stylesheet" href="css/headfooter_boton.css">
    <link rel="stylesheet" href="css/detalle_descanso.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.cdnfonts.com/css/opendyslexic" rel="stylesheet">
    
    <style>
        /* Animación para el Metrónomo de Cadencia */
        @keyframes pulseCadence {
            0% { transform: scale(1); opacity: 0.8; }
            50% { transform: scale(1.25); opacity: 1; background: #4caf50; }
            100% { transform: scale(1); opacity: 0.8; }
        }
        .cadence-active {
            animation: pulseCadence 1.2s infinite ease-in-out;
        }
    </style>
</head>
<body>

    <!-- Header Principal -->
    <header class="main-header">
        <a href="index.php" class="logo-area" id="logoBtn" style="text-decoration: none; color: inherit;">
            <img src="img/logo.png" alt="Nutrition Express Logo">
            <div class="logo-text">
                <span class="brand-title">Nutrition</span>
                <span class="brand-sub">Express</span>
            </div>
        </a>

        <nav class="nav-links">
            <a href="index.php">Home</a>
            <a href="expertos1.php">Experts</a>
            <a href="carpetas.php" class="active">Plans</a>
            <a href="calculadora.php">Calculator</a>
            <a href="servicios.php">Services</a>
            <a href="nosotros.php">About Us</a>
            <a href="perfil.php">Profile</a>
        </nav>

        <a href="citas.php" class="header-btn-schedule" id="headerScheduleBtn" style="text-align: center; text-decoration: none; display: inline-block;">
            <i class="fa-regular fa-calendar-days"></i> Schedule Appointment
        </a>
    </header>

    <main class="container">
        <div class="guide-container">
            <a href="catalogo_ejercicio.php" class="back-btn">
                <i class="fa-solid fa-arrow-left"></i> Back to Exercise Catalog
            </a>

            <!-- Banner Dinámico -->
            <div class="hero-banner">
                <img src="<?= htmlspecialchars($plan['image']) ?>" alt="<?= htmlspecialchars($plan['title']) ?>" style="object-fit: contain; background: rgba(0,0,0,0.2); padding: 20px;">
                <div class="hero-overlay">
                    <span class="badge-code <?= $plan['badge_class'] ?>"><?= htmlspecialchars($planId) ?></span>
                    <h1><?= htmlspecialchars($plan['title']) ?></h1>
                    <p><?= htmlspecialchars($plan['category']) ?></p>
                    <div class="protocol-meta">
                        <span class="meta-tag"><i class="fa-solid fa-bullseye"></i> Target: <?= htmlspecialchars($plan['target']) ?></span>
                        <span class="meta-tag"><i class="fa-regular fa-clock"></i> Duration: <?= htmlspecialchars($plan['duration']) ?></span>
                        <span class="meta-tag"><i class="fa-solid fa-repeat"></i> Freq: <?= htmlspecialchars($plan['frequency']) ?></span>
                    </div>
                </div>
            </div>

            <!-- Resumen -->
            <p class="protocol-summary">
                <?= htmlspecialchars($plan['summary']) ?>
            </p>

            <!-- Herramienta Interactiva -->
            <h2 class="section-title"><i class="fa-solid fa-stopwatch"></i> Workout Interactive Tool</h2>
            <div class="breathing-card">
                <div class="breathing-info">
                    <h3><?= htmlspecialchars($plan['tool_title']) ?></h3>
                    <p><?= htmlspecialchars($plan['tool_desc']) ?></p>
                </div>
                <button type="button" class="btn-start-breathing" onclick="openInteractiveModal(event)">
                    <i class="fa-solid fa-play"></i> <?= htmlspecialchars($plan['tool_btn']) ?>
                </button>
            </div>

            <!-- Pasos del Entrenamiento -->
            <h2 class="section-title"><i class="fa-solid fa-dumbbell"></i> Routine Breakdown & Exercises</h2>
            <div class="timeline">
                <?php foreach ($plan['timeline'] as $step): ?>
                    <div class="timeline-step">
                        <span class="time-badge"><?= htmlspecialchars($step['time']) ?></span>
                        <div class="step-title"><?= $step['action'] ?></div>
                        <div class="step-desc"><?= htmlspecialchars($step['desc']) ?></div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Checklist -->
            <h2 class="section-title"><i class="fa-solid fa-square-check"></i> Daily Workout Checklist</h2>
            <div class="checklist-box">
                <?php foreach ($plan['checklist'] as $item): ?>
                    <label class="checklist-item">
                        <input type="checkbox">
                        <span><?= htmlspecialchars($item) ?></span>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>
    </main>

    <!-- Modal Interactivo Dinámico -->
    <div id="interactiveModal" class="modal-overlay">
        <div class="modal-content" style="text-align: center; max-width: 450px;">
            <button class="close-modal" onclick="closeInteractiveModal()">&times;</button>
            <h3 style="margin-bottom: 5px;" id="modalTitle"><?= htmlspecialchars($plan['tool_title']) ?></h3>
            <p style="font-size: 0.9rem; color: #666; margin-bottom: 15px;" id="modalSubtext">Press Start when ready.</p>
            
            <div class="breathing-circle-container">
                <div id="interactiveCircle" class="breathing-circle">
                    <span id="circleText">Ready</span>
                </div>
            </div>
            
            <div id="repCounterControls" style="display: none; margin-top: 15px; gap: 10px; justify-content: center;">
                <button type="button" class="btn-start-breathing" style="background: #2e7d32; padding: 10px 20px;" onclick="addRep()">+ 1 Rep</button>
                <button type="button" class="btn-start-breathing" style="background: #0288d1; padding: 10px 20px;" onclick="nextSet()">Next Set</button>
            </div>

            <button type="button" id="startCircleBtn" class="btn-start-breathing" style="margin-top: 15px;" onclick="startRoutine('<?= $plan['tool_type'] ?>')">
                Start Session
            </button>
        </div>
    </div>

    <!-- Modal Emergente para Videos -->
    <div id="videoModal" class="modal-overlay">
        <div class="modal-content" style="max-width: 680px; width: 92%; padding: 20px; text-align: center;">
            <button class="close-modal" onclick="closeVideoModal()">&times;</button>
            <h3 style="margin-bottom: 12px; font-size: 1.2rem;">Exercise Technique Guide</h3>
            <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: 12px; background: #000;">
                <iframe id="videoIframe" src="" style="position: absolute; top:0; left: 0; width: 100%; height: 100%; border: 0;" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div style="margin-top: 12px;">
                <a id="externalVideoLink" href="#" target="_blank" rel="noopener" style="color: #0288d1; font-size: 0.85rem; text-decoration: underline;">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i> Open video directly in YouTube if player is restricted
                </a>
            </div>
        </div>
    </div>

    <!-- ACCESSIBILITY PANEL -->
    <button id="accessibilityBtn" class="access-btn" title="Accessibility Options" onclick="toggleAccessPanel()">♿</button>

    <div id="accessibilityPanel" class="access-panel">
        <h3>Quick Accessibility</h3>
        <div class="accessibility-grid">
            <div class="access-item" id="textAccessItem" onclick="toggleZoomButtons(event)">
                <div class="access-icon text-icon">A</div>
                <div class="zoom-buttons" id="zoomContainer">
                    <button type="button" onclick="changeFontSize(1, event)" title="Increase font size">+</button>
                    <button type="button" onclick="changeFontSize(-1, event)" title="Decrease font size">-</button>
                </div>
                <span>Large Text</span>
            </div>

            <div class="access-item" role="button" onclick="toggleContrast()">
                <div class="access-icon"><i class="fa-solid fa-circle-half-stroke"></i></div>
                <span style="font-size: 13px;">High Contrast</span>
            </div>

            <div class="access-item" role="button" onclick="toggleDarkMode()">
                <div class="access-icon"><i class="fa-solid fa-moon"></i></div>
                <span>Dark Mode</span>
            </div>

            <div class="access-item" role="button" onclick="resetAccessibility()">
                <div class="access-icon"><i class="fa-solid fa-rotate-left"></i></div>
                <span>Reset All</span>
            </div>

            
            <div class="access-item" role="button" tabindex="0" onclick="readSelectedText()">
    <div class="access-icon"><i class="fa-solid fa-volume-high"></i></div>
    <span>Read Aloud</span>
</div>

            <div class="access-item" role="button" onclick="toggleDyslexia()">
                <div class="access-icon"><i class="fa-solid fa-book-open"></i></div>
                <span>Dyslexia Mode</span>
            </div>

            <div class="access-item" role="button" onclick="toggleLetterSpacing()">
                <div class="access-icon letter-space">AAA</div>
                <span>More Spacing</span>
            </div>

            <div class="access-item" role="button" onclick="toggleFocusVisible()">
                <div class="access-icon"><i class="fa-solid fa-expand"></i></div>
                <span>Visible Focus</span>
            </div>
        </div>
        <p class="panel-footer">You can change these options at any time.</p>
    </div>

    <!-- Scripts -->
    <script src="js/script.js"></script>
    <script src="js/asistente.js"></script>
    <script>
        let timerInterval = null;
        let isRunning = false;
        let currentReps = 0;
        let currentSets = 1;

        // Reproductor de Video Modal Seguro
        function openVideoModal(embedUrl, e) {
            if (e) e.preventDefault();
            const videoIframe = document.getElementById('videoIframe');
            const externalLink = document.getElementById('externalVideoLink');
            
            // Extraer ID de YouTube para el enlace externo de respaldo
            const videoId = embedUrl.split('/embed/')[1];
            externalLink.href = `https://www.youtube.com/watch?v=${videoId}`;

            videoIframe.src = embedUrl + "?rel=0&modestbranding=1";
            document.getElementById('videoModal').style.display = 'flex';
        }

        function closeVideoModal() {
            const videoIframe = document.getElementById('videoIframe');
            videoIframe.src = "";
            document.getElementById('videoModal').style.display = 'none';
        }

        // Modal Interactivo
        function openInteractiveModal(e) {
            if (e) e.preventDefault();
            document.getElementById('interactiveModal').style.display = 'flex';
        }

        function closeInteractiveModal() {
            document.getElementById('interactiveModal').style.display = 'none';
            stopRoutine();
        }

        // Controladores de Herramientas Interactivas
        function startRoutine(type) {
            if (isRunning && type !== 'rep_counter') return;
            isRunning = true;

            const circle = document.getElementById('interactiveCircle');
            const text = document.getElementById('circleText');
            const btn = document.getElementById('startCircleBtn');
            const subtext = document.getElementById('modalSubtext');
            const repControls = document.getElementById('repCounterControls');

            if (type === 'plank') {
                btn.style.display = 'none';
                subtext.innerText = "Hold tight, maintain lumbar neutrality!";
                circle.style.background = "#2e7d32";
                circle.style.transform = "scale(1.2)";
                let sec = 60;
                timerInterval = setInterval(() => {
                    sec--;
                    text.innerText = `${sec}s`;
                    if (sec <= 0) {
                        text.innerText = "Done!";
                        stopRoutine();
                    }
                }, 1000);

            } else if (type === 'cadence') {
                btn.style.display = 'none';
                subtext.innerText = "Follow the expanding visual rhythm to match stride cadence.";
                circle.classList.add('cadence-active');
                text.innerText = "Keep Pace";

            } else if (type === 'rep_counter') {
                btn.style.display = 'none';
                repControls.style.display = 'flex';
                currentReps = 0;
                currentSets = 1;
                updateRepDisplay();

            } else { // Interval por defecto
                btn.style.display = 'none';
                subtext.innerText = "Resting between active sets...";
                circle.style.background = "#0288d1";
                circle.style.transform = "scale(1.15)";
                let sec = 45;
                timerInterval = setInterval(() => {
                    sec--;
                    text.innerText = `${sec}s`;
                    if (sec <= 0) {
                        text.innerText = "Next Set!";
                        stopRoutine();
                    }
                }, 1000);
            }
        }

        // Lógica para Contador de Repeticiones y Series
        function addRep() {
            currentReps++;
            updateRepDisplay();
        }

        function nextSet() {
            currentSets++;
            currentReps = 0;
            updateRepDisplay();
        }

        function updateRepDisplay() {
            const circle = document.getElementById('interactiveCircle');
            const subtext = document.getElementById('modalSubtext');
            circle.style.background = "#e65100";
            subtext.innerText = `Set ${currentSets} of 4 in progress`;
            circle.innerHTML = `<span style="font-size: 1.8rem; font-weight: bold;">${currentReps}</span><span style="font-size: 0.8rem;">REPS</span>`;
        }

        function stopRoutine() {
            isRunning = false;
            clearInterval(timerInterval);
            const circle = document.getElementById('interactiveCircle');
            const text = document.getElementById('circleText');
            const btn = document.getElementById('startCircleBtn');
            const subtext = document.getElementById('modalSubtext');
            const repControls = document.getElementById('repCounterControls');

            if (circle) {
                circle.className = "breathing-circle";
                circle.style.transform = "scale(1)";
                circle.style.background = "";
                circle.innerHTML = `<span id="circleText">Ready</span>`;
            }
            if (repControls) repControls.style.display = 'none';
            if (btn) btn.style.display = 'inline-block';
            if (subtext) subtext.innerText = "Press Start when ready.";
        }
    </script>
</body>
</html>