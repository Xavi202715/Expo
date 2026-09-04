<?php
// Capturar el código del plan desde la URL (R-01, R-02, REC-01, RST-01, RST-02)
$planId = $_GET['code'] ?? $_GET['id'] ?? 'R-01';
$planId = strtoupper(trim($planId));

// Base de datos de todos los planes con sus videos en formato Embed para Modal interno
$planes = [
    // ---------------- VERDES: SLEEP HYGIENE ----------------
    'R-01' => [
        'title' => 'Deep Sleep Protocol',
        'category' => 'Sleep Hygiene & Night Routines',
        'badge_class' => 'badge-green',
        'image' => 'https://images.unsplash.com/photo-1541781774459-bb2af2f05b55?q=80&w=600&auto=format&fit=crop',
        'target' => '8 Hours Rest',
        'duration' => '14 Days',
        'summary' => 'A step-by-step evening blueprint engineered to optimize natural melatonin, lower core body temperature, and transition your nervous system into deep REM sleep.',
        'tool_title' => '4-7-8 Breathing Trainer',
        'tool_desc' => 'Follow the visual rhythm to activate your parasympathetic nervous system: Inhale (4s), Hold (7s), Exhale (8s).',
        'tool_btn' => 'Start Breathing Guide',
        'tool_type' => 'breathing',
        'timeline' => [
            ['time' => '2 Hours Before Bed', 'action' => 'Digital & Light Detox', 'desc' => 'Turn off harsh overhead lights and enable night mode on devices to permit natural melatonin synthesis.'],
            ['time' => '1 Hour Before Bed', 'action' => 'Thermic & Herbal Transition', 'desc' => 'Take a warm shower and sip chamomile or valerian tea. The drop in body temperature triggers sleep signals.'],
            ['time' => '30 Minutes Before Bed', 'action' => '<a href="#" class="breathing-link" onclick="openVideoModal(\'https://www.youtube.com/embed/gz4G31LGyog\', event)">4-7-8 Parasympathetic Breathing</a>', 'desc' => 'Perform 4 cycles of 4-7-8 breathing in bed to lower your heart rate.'],
            ['time' => 'Bedtime', 'action' => 'Optimal Sleep Environment', 'desc' => 'Ensure room temperature is set to 65-68°F (18-20°C) with total blackout curtains.']
        ],
        'checklist' => [
            'No caffeine consumption after 2:00 PM',
            'Bedroom temperature lowered to 65-68°F',
            'Screens turned off or blue-blocker glasses on',
            'Completed 4-7-8 breathing exercise in bed'
        ]
    ],
    'R-02' => [
        'title' => 'Circadian Sync',
        'category' => 'Sleep Hygiene & Night Routines',
        'badge_class' => 'badge-green',
        'image' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?q=80&w=600&auto=format&fit=crop',
        'target' => '7.5 Hours Rest',
        'duration' => '21 Days',
        'summary' => 'Align your internal sleep-wake cycle with natural sunlight exposure to fix erratic sleep schedules effortlessly and boost daytime alertness.',
        'tool_title' => 'Morning Sunlight Exposure Timer',
        'tool_desc' => 'Step outdoors within 30 minutes of waking up to anchor your circadian rhythm with natural sunlight photons.',
        'tool_btn' => 'Start Sunlight Timer',
        'tool_type' => 'sunlight',
        'timeline' => [
            ['time' => 'Within 30 Min of Waking', 'action' => '<a href="#" class="breathing-link" onclick="openVideoModal(\'https://www.youtube.com/embed/NAATB55oxeU\', event)">Morning Sunlight Exposure Protocol</a>', 'desc' => 'Step outside for 10-15 minutes without sunglasses to trigger morning cortisol release and reset your central clock.'],
            ['time' => 'Midday (12:00 PM)', 'action' => 'Solar Anchor & Physical Movement', 'desc' => 'Get bright outdoor light exposure during lunch. Prevents afternoon dips and reinforces nighttime sleepiness.'],
            ['time' => 'Sunset', 'action' => 'Twilight Spectrum Transition', 'desc' => 'Observe the sunset or switch indoor lights to dim warm tones, signaling nighttime transition to the brain.'],
            ['time' => 'Bedtime', 'action' => 'Dark Horizon Phase', 'desc' => 'Sleep in total darkness. Complete light restriction optimizes nocturnal melatonin secretion.']
        ],
        'checklist' => [
            'Got 10-15 minutes of natural morning sunlight',
            'Avoided wearing sunglasses during morning light walk',
            'Maintained a consistent wake-up time (±30 mins)',
            'Switched indoor lights to warm dim lighting after sunset'
        ]
    ],

    // ---------------- NARANJAS: ACTIVE BODY RECOVERY ----------------
    'REC-01' => [
        'title' => 'Post-Workout Reset',
        'category' => 'Active Body Recovery',
        'badge_class' => 'badge-orange',
        'image' => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?q=80&w=600&auto=format&fit=crop',
        'target' => 'Muscle Repair',
        'duration' => '7 Days',
        'summary' => 'Gentle mobility routines, cellular hydration strategies, and restorative stretching tailored to lower post-exercise cortisol levels and repair sore muscles.',
        'tool_title' => 'Post-Workout Mobility Stretches',
        'tool_desc' => 'Perform 60-second gentle holding stretches to release muscle tension and jumpstart recovery.',
        'tool_btn' => 'Start Stretch Timer',
        'tool_type' => 'stretch',
        'timeline' => [
            ['time' => 'Post-Workout (0-30 min)', 'action' => 'Glycogen & Protein Refuel', 'desc' => 'Consume a 3:1 carb-to-protein ratio snack with electrolyte-enriched water to accelerate muscle cell repair.'],
            ['time' => '1 Hour Post-Workout', 'action' => '<a href="#" class="breathing-link" onclick="openVideoModal(\'https://www.youtube.com/embed/0qC3A2u_YdE\', event)">Full Body Foam Rolling Guide</a>', 'desc' => 'Spend 10 minutes foam rolling major muscle groups used during your training session.'],
            ['time' => 'Evening Routine', 'action' => 'Magnesium & Mobility Stretch', 'desc' => 'Take magnesium glycinate and perform a 15-minute restorative yoga or hamstring stretch sequence.'],
            ['time' => 'Night Rest', 'action' => 'Elevated Leg Recovery', 'desc' => 'Elevate legs against a wall for 10 minutes before sleep to enhance lymphatic drainage.']
        ],
        'checklist' => [
            'Replenished hydration with electrolyte fluids',
            'Completed 10 minutes of foam rolling',
            'Took recommended nighttime recovery supplements',
            'Completed 15-minute gentle evening stretching'
        ]
    ],

    // ---------------- ROJOS: BURNOUT RESET ----------------
    'RST-01' => [
        'title' => 'Burnout & Nervous System Reset',
        'category' => 'High Intensity Rest & Burnout Reset',
        'badge_class' => 'badge-red',
        'image' => 'https://images.unsplash.com/photo-1518241353330-0f7941c2d9b5?q=80&w=600&auto=format&fit=crop',
        'target' => 'Total Reset',
        'duration' => '30 Days',
        'summary' => 'Intensive clinical recovery protocol designed for extreme exhaustion, adrenal fatigue management, and complete sympathetic nervous system calming.',
        'tool_title' => 'Non-Sleep Deep Rest (NSDR) Session',
        'tool_desc' => 'A guided somatic relaxation technique to deeply calm your central nervous system without entering full sleep.',
        'tool_btn' => 'Start NSDR Timer',
        'tool_type' => 'nsdr',
        'timeline' => [
            ['time' => 'Mid-Morning (10:00 AM)', 'action' => 'Sensory Deprivation Pause', 'desc' => 'Disconnect from screens for 20 minutes. Practice eyes-closed diaphragmatic grounding.'],
            ['time' => 'Midday (1:30 PM)', 'action' => '<a href="#" class="breathing-link" onclick="openVideoModal(\'https://www.youtube.com/embed/pL02HRFk2vo\', event)">Guided NSDR Protocol Video</a>', 'desc' => 'Perform a 20-minute NSDR session lying flat on your back to restore striatal dopamine reserves.'],
            ['time' => 'Late Afternoon', 'action' => 'Zero-Stimulant Boundary', 'desc' => 'Strict stop on caffeine, intense work tasks, and high-stress cognitive inputs.'],
            ['time' => 'Night Rest', 'action' => 'Thermal Shock / Cold-Hot Hydrotherapy', 'desc' => 'Alternate warm shower with cool water rinse to stimulate vagal nerve tone before bed.']
        ],
        'checklist' => [
            'No high-caffeine beverages after 11:00 AM',
            'Completed 20-minute NSDR restorative session',
            'Disconnected completely from work emails after 6:00 PM',
            'Maintained full sensory isolation during rest periods'
        ]
    ],
    'RST-02' => [
        'title' => 'Insomnia Overhaul',
        'category' => 'High Intensity Rest & Burnout Reset',
        'badge_class' => 'badge-red',
        'image' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?q=80&w=600&auto=format&fit=crop',
        'target' => 'Advanced',
        'duration' => '14 Days',
        'summary' => 'A cognitive sleep restructuring program engineered to break negative sleep associations, eliminate bed-related anxiety, and restore natural REM cycles.',
        'tool_title' => 'Progressive Muscle Relaxation (PMR)',
        'tool_desc' => 'Systematically tense and release muscle groups from head to toe to eliminate physical sleep anxiety.',
        'tool_btn' => 'Start PMR Session',
        'tool_type' => 'pmr',
        'timeline' => [
            ['time' => 'All Day Constraint', 'action' => 'Strict Bed Association', 'desc' => 'Never use your bed for reading, working, or watching media. The bed is exclusively reserved for sleep.'],
            ['time' => '30 Min Before Bed', 'action' => 'Cognitive Brain Dump', 'desc' => 'Write down all pending thoughts, worries, and tomorrow tasks in a physical journal to clear working memory.'],
            ['time' => 'In Bed', 'action' => '<a href="#" class="breathing-link" onclick="openVideoModal(\'https://www.youtube.com/embed/1nZEdqcGVzo\', event)">Progressive Muscle Relaxation Guide</a>', 'desc' => 'Contract each muscle group for 5 seconds and release for 10 seconds, starting from your toes up to your face.'],
            ['time' => 'If Awake > 20 Mins', 'action' => '20-Minute Reset Rule', 'desc' => 'If unable to sleep after 20 minutes, get out of bed, move to a dimly lit room, read quietly, and return only when sleepy.']
        ],
        'checklist' => [
            'Used bed only for sleep (no screens or reading)',
            'Completed physical journal brain dump before entering bedroom',
            'Executed PMR sequence in bed',
            'Applied the 20-minute rule if waking up during the night'
        ]
    ]
];

// Asignar datos del plan seleccionado
$plan = $planes[$planId] ?? $planes['R-01'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($plan['title']) ?> - Nutrition Express</title>
    
    <!-- External Stylesheets -->
    <link rel="stylesheet" href="css/headfooter_boton.css">
    <link rel="stylesheet" href="css/detalle_descanso.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.cdnfonts.com/css/opendyslexic" rel="stylesheet">
</head>
<body>

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

        <a href="citas.php" class="header-btn-schedule" id="headerScheduleBtn">
            <i class="fa-regular fa-calendar-days"></i> Schedule Appointment
        </a>
    </header>

    <main class="container">
        <div class="guide-container">
            <a href="catalogo_descanso.php" class="back-btn">
                <i class="fa-solid fa-arrow-left"></i> Back to Catalog
            </a>

            <!-- Header Banner Dynamic -->
            <div class="hero-banner">
                <img src="<?= htmlspecialchars($plan['image']) ?>" alt="<?= htmlspecialchars($plan['title']) ?>">
                <div class="hero-overlay">
                    <span class="badge-code <?= $plan['badge_class'] ?>"><?= htmlspecialchars($planId) ?></span>
                    <h1><?= htmlspecialchars($plan['title']) ?></h1>
                    <p><?= htmlspecialchars($plan['category']) ?></p>
                    <div class="protocol-meta">
                        <span class="meta-tag"><i class="fa-regular fa-clock"></i> Target: <?= htmlspecialchars($plan['target']) ?></span>
                        <span class="meta-tag"><i class="fa-regular fa-calendar"></i> Duration: <?= htmlspecialchars($plan['duration']) ?></span>
                    </div>
                </div>
            </div>

            <!-- Overview -->
            <p class="protocol-summary">
                <?= htmlspecialchars($plan['summary']) ?>
            </p>

            <!-- Interactive Tool Section -->
            <h2 class="section-title"><i class="fa-solid fa-bolt"></i> Interactive Recovery Tool</h2>
            <div class="breathing-card">
                <div class="breathing-info">
                    <h3><?= htmlspecialchars($plan['tool_title']) ?></h3>
                    <p><?= htmlspecialchars($plan['tool_desc']) ?></p>
                </div>
                <button type="button" class="btn-start-breathing" onclick="openInteractiveModal(event)">
                    <i class="fa-solid fa-play"></i> <?= htmlspecialchars($plan['tool_btn']) ?>
                </button>
            </div>

            <!-- Step-by-Step Protocol -->
            <h2 class="section-title"><i class="fa-solid fa-list-check"></i> Step-by-Step Action Protocol</h2>
            <div class="timeline">
                <?php foreach ($plan['timeline'] as $step): ?>
                    <div class="timeline-step">
                        <span class="time-badge"><?= htmlspecialchars($step['time']) ?></span>
                        <div class="step-title"><?= $step['action'] ?></div>
                        <div class="step-desc"><?= htmlspecialchars($step['desc']) ?></div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Actionable Checklist -->
            <h2 class="section-title"><i class="fa-solid fa-square-check"></i> Daily Protocol Checklist</h2>
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

    <!-- Modal Interactivo Global (Círculo) -->
    <div id="interactiveModal" class="modal-overlay">
        <div class="modal-content" style="text-align: center;">
            <button class="close-modal" onclick="closeInteractiveModal()">&times;</button>
            <h3 style="margin-bottom: 5px;"><?= htmlspecialchars($plan['tool_title']) ?></h3>
            <p style="font-size: 0.9rem; color: #666; margin-bottom: 15px;" id="modalSubtext">Press Start when ready.</p>
            
            <div class="breathing-circle-container">
                <div id="interactiveCircle" class="breathing-circle">
                    <span id="circleText">Ready</span>
                </div>
            </div>
            
            <button type="button" id="startCircleBtn" class="btn-start-breathing" onclick="startRoutine('<?= $plan['tool_type'] ?>')">
                Start Session
            </button>
        </div>
    </div>

    <!-- Modal Emergente Mediano para Videos -->
    <div id="videoModal" class="modal-overlay">
        <div class="modal-content" style="max-width: 650px; width: 90%; padding: 20px; text-align: center;">
            <button class="close-modal" onclick="closeVideoModal()">&times;</button>
            <h3 style="margin-bottom: 15px;">Tutorial Video</h3>
            <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: 12px; background: #000;">
                <iframe id="videoIframe" src="" style="position: absolute; top:0; left: 0; width: 100%; height: 100%; border: 0;" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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

              <!-- Botón dinámico Mute / Unmute Assistant -->
<div class="access-item" id="muteAssistantBtn" role="button" tabindex="0" onclick="toggleMuteAssistant()">
    <div class="access-icon"><i id="muteAssistantIcon" class="fa-solid fa-volume-xmark"></i></div>
    <span id="muteAssistantText">Mute Assistant</span>
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

    <!-- Scripts Globales e Interactividad -->
    <script src="js/script.js"></script>
    <script src="js/asistente.js"></script>
    <script>
        let timerInterval = null;
        let isRunning = false;

        // Modal de Video Interno
        function openVideoModal(embedUrl, e) {
            if (e) e.preventDefault();
            const videoIframe = document.getElementById('videoIframe');
            videoIframe.src = embedUrl + "?autoplay=1";
            document.getElementById('videoModal').style.display = 'flex';
        }

        function closeVideoModal() {
            const videoIframe = document.getElementById('videoIframe');
            videoIframe.src = "";
            document.getElementById('videoModal').style.display = 'none';
        }

        // Modal de Herramienta Animada
        function openInteractiveModal(e) {
            if (e) e.preventDefault();
            document.getElementById('interactiveModal').style.display = 'flex';
        }

        function closeInteractiveModal() {
            document.getElementById('interactiveModal').style.display = 'none';
            stopRoutine();
        }

        function startRoutine(type) {
            if (isRunning) return;
            isRunning = true;

            const circle = document.getElementById('interactiveCircle');
            const text = document.getElementById('circleText');
            const btn = document.getElementById('startCircleBtn');
            const subtext = document.getElementById('modalSubtext');

            btn.style.display = 'none';

            if (type === 'breathing') {
                subtext.innerText = "Follow rhythm: Inhale, Hold, Exhale.";
                function cycle() {
                    text.innerText = "Inhale (4s)";
                    circle.className = "breathing-circle inhale";

                    setTimeout(() => {
                        if (!isRunning) return;
                        text.innerText = "Hold (7s)";
                        circle.className = "breathing-circle hold";

                        setTimeout(() => {
                            if (!isRunning) return;
                            text.innerText = "Exhale (8s)";
                            circle.className = "breathing-circle exhale";
                        }, 7000);
                    }, 4000);
                }
                cycle();
                timerInterval = setInterval(cycle, 19000);

            } else if (type === 'sunlight') {
                subtext.innerText = "Absorbing natural light...";
                circle.style.background = "#f59e0b";
                circle.style.transform = "scale(1.4)";
                let sec = 600;
                timerInterval = setInterval(() => {
                    sec--;
                    let m = Math.floor(sec / 60), s = sec % 60;
                    text.innerText = `${m}:${s < 10 ? '0' : ''}${s}`;
                    if (sec <= 0) stopRoutine();
                }, 1000);

            } else {
                subtext.innerText = "Somatic focus active. Relax deeply...";
                circle.style.background = "#3b82f6";
                circle.style.transform = "scale(1.3)";
                let sec = 300;
                timerInterval = setInterval(() => {
                    sec--;
                    let m = Math.floor(sec / 60), s = sec % 60;
                    text.innerText = `${m}:${s < 10 ? '0' : ''}${s}`;
                    if (sec <= 0) stopRoutine();
                }, 1000);
            }
        }

        function stopRoutine() {
            isRunning = false;
            clearInterval(timerInterval);
            const circle = document.getElementById('interactiveCircle');
            const text = document.getElementById('circleText');
            const btn = document.getElementById('startCircleBtn');
            const subtext = document.getElementById('modalSubtext');

            if (circle) {
                circle.className = "breathing-circle";
                circle.style.transform = "scale(1)";
                circle.style.background = "";
            }
            if (text) text.innerText = "Ready";
            if (btn) btn.style.display = 'inline-block';
            if (subtext) subtext.innerText = "Press Start when ready.";
        }
    </script>

</body>
</html>