<?php
// Capturar el código del plan desde la URL (ej: AB-G1-01, AB-G2-01, AB-C1-01, AB-A3-01, etc.)
$planId = $_GET['code'] ?? $_GET['id'] ?? 'AB-G1-01';
$planId = strtoupper(trim($planId));

// Base de datos de todos los planes de ALIMENTACIÓN / NUTRICIÓN con URLs directas de YouTube Embed
$planes = [
    // ---------------- VERDES: GENERAL AND PREVENTIVE PLANS ----------------
    'AB-G1-01' => [
        'title' => 'General Balanced Nutrition',
        'category' => 'General & Preventive Plans',
        'badge_class' => 'badge-green',
        'image' => 'https://images.unsplash.com/photo-1498837167922-ddd27525d352?q=80&w=600&auto=format&fit=crop',
        'target' => 'Healthy Habits',
        'duration' => '30 Days',
        'summary' => 'Complete daily nutrition guide engineered to establish sustainable eating habits, balance energy levels, and optimize overall wellness through wholesome macronutrients.',
        'tool_title' => 'Mindful Eating Pacing Guide',
        'tool_desc' => 'Follow the visual progress bar to slow down your chewing speed and improve digestion.',
        'tool_type' => 'pacing',
        'timeline' => [
            ['time' => 'Breakfast (7:30 AM)', 'action' => 'Balanced Starter', 'desc' => 'Whole grains, boiled eggs, and fresh fruits to kickstart metabolism.'],
            ['time' => 'Lunch (12:30 PM)', 'action' => '<a href="#" class="breathing-link" onclick="openVideoModal(\'https://www.youtube-nocookie.com/embed/v3R2g85HwMo\', event)">Healthy Meal Prep & Chicken Salad Guide</a>', 'desc' => 'Lean chicken breast, quinoa, steamed vegetables, and healthy fats.'],
            ['time' => 'Snack (4:00 PM)', 'action' => 'Nutrient Boost', 'desc' => 'A handful of walnuts or almonds with a fresh green apple.'],
            ['time' => 'Dinner (7:30 PM)', 'action' => 'Light Evening Meal', 'desc' => 'Steamed white fish or tofu with leafy green salad to support overnight digestion.']
        ],
        'checklist' => [
            'Drank at least 2.5 Liters of water throughout the day',
            'Included a lean protein source in all 3 main meals',
            'Avoided ultra-processed snacks and sugary drinks',
            'Consumed at least 3 servings of fresh vegetables'
        ]
    ],
    'AB-G2-01' => [
        'title' => 'Active Lifestyle & Longevity',
        'category' => 'General & Preventive Plans',
        'badge_class' => 'badge-green',
        'image' => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?q=80&w=600&auto=format&fit=crop',
        'target' => 'Energy & Vitality',
        'duration' => '45 Days',
        'summary' => 'Optimal macronutrient distribution tailored for active individuals to maintain peak performance, reduce oxidative stress, and support cell longevity.',
        'tool_title' => 'Daily Hydration Goal Tracker',
        'tool_desc' => 'Track your target water glasses throughout the day to ensure optimal cell hydration.',
        'tool_type' => 'water',
        'timeline' => [
            ['time' => 'Morning Fuel', 'action' => '<a href="#" class="breathing-link" onclick="openVideoModal(\'https://www.youtube-nocookie.com/embed/2_mP_e_vVd8\', event)">High Protein Overnight Oats Tutorial</a>', 'desc' => 'Oats topped with chia seeds, blueberries, and a scoop of clean protein.'],
            ['time' => 'Mid-Day Lunch', 'action' => 'Quinoa & Wild Salmon', 'desc' => 'Wild salmon fillet served over mixed greens, quinoa, and walnuts.'],
            ['time' => 'Post-Activity', 'action' => 'Recovery Shake', 'desc' => 'Electrolyte water paired with a banana and protein blend.'],
            ['time' => 'Night Dinner', 'action' => 'Restorative Plate', 'desc' => 'Grilled turkey breast with roasted sweet potatoes and asparagus.']
        ],
        'checklist' => [
            'Consumed pre-workout complex carbs 90 mins prior to exercise',
            'Included high-antioxidant berries in daily diet',
            'Maintained electrolyte balance during activity',
            'Met daily target of omega-3 rich healthy fats'
        ]
    ],
    'AB-G1-02' => [
        'title' => 'Weight Management Starter',
        'category' => 'General & Preventive Plans',
        'badge_class' => 'badge-green',
        'image' => 'https://images.unsplash.com/photo-1540420773420-3366772f4999?q=80&w=600&auto=format&fit=crop',
        'target' => 'Weight Reduction',
        'duration' => '30 Days',
        'summary' => 'A structured portion control blueprint designed for healthy, gradual weight loss without nutrient deficiencies or energy drops.',
        'tool_title' => 'Smart Meal Swap Tool',
        'tool_desc' => 'Interactive toggle tool to find low-calorie, high-satiety substitutions.',
        'tool_type' => 'swaps',
        'timeline' => [
            ['time' => 'Breakfast', 'action' => 'High-Fiber Breakfast', 'desc' => 'Spinach scramble with 2 egg whites + 1 whole egg and whole-grain toast.'],
            ['time' => 'Lunch', 'action' => '<a href="#" class="breathing-link" onclick="openVideoModal(\'https://www.youtube-nocookie.com/embed/942-83g7Yw8\', event)">Healthy Lunch Box Prep Tutorial</a>', 'desc' => 'Steamed greens, grilled chicken, quinoa, and 1/4 avocado.'],
            ['time' => 'Afternoon', 'action' => 'Hydration Break', 'desc' => 'Green tea or herbal infusion with cucumber slices.'],
            ['time' => 'Dinner', 'action' => 'Low-Glycemic Dinner', 'desc' => 'Baked white fish with zucchini noodles and tomato basil sauce.']
        ],
        'checklist' => [
            'Measured main portions using the hand-guide rule',
            'Ate lunch slowly taking at least 20 minutes',
            'Replaced sweet beverages with water or herbal tea',
            'Finished dinner at least 3 hours before bed'
        ]
    ],
    'AB-G2-02' => [
        'title' => 'Metabolic Reset & Fat Loss',
        'category' => 'General & Preventive Plans',
        'badge_class' => 'badge-green',
        'image' => 'https://images.unsplash.com/photo-1490645935967-10de6ba17061?q=80&w=600&auto=format&fit=crop',
        'target' => 'Fat Loss & Muscle Retention',
        'duration' => '45 Days',
        'summary' => 'Caloric deficit protocol optimized with high protein density to promote fat oxidation while preserving lean muscle mass.',
        'tool_title' => 'Mindful Eating Pacing Guide',
        'tool_desc' => 'Use this guided rhythm during high-protein meals to slow down ingestion speed.',
        'tool_type' => 'pacing',
        'timeline' => [
            ['time' => 'First Meal (12:00 PM)', 'action' => '<a href="#" class="breathing-link" onclick="openVideoModal(\'https://www.youtube-nocookie.com/embed/S_8S3-Hl1a0\', event)">Quick Fat Loss Salmon Prep</a>', 'desc' => 'Turkey breast, cauliflower rice, roasted asparagus, and berries.'],
            ['time' => 'Snack (3:30 PM)', 'action' => 'Satiety Snack', 'desc' => 'Greek yogurt with ground flaxseeds.'],
            ['time' => 'Second Meal (7:30 PM)', 'action' => 'Nutrient Dense Dinner', 'desc' => 'Grilled beef tenderloin or seared tofu with broccoli and olive oil.'],
            ['time' => 'Fasting Window', 'action' => 'Metabolic Rest', 'desc' => 'Zero-calorie hydration period until noon the following day.']
        ],
        'checklist' => [
            'Completed target fasting window',
            'Achieved protein requirement per main meal',
            'Kept daily refined carb intake below target limit',
            'Logged all meals in the tracker'
        ]
    ],

    // ---------------- NARANJAS: CONDITION CONTROL PLANS ----------------
    'AB-C1-01' => [
        'title' => 'Beginner Glycemic Care',
        'category' => 'Condition Control Plans',
        'badge_class' => 'badge-orange',
        'image' => 'https://images.unsplash.com/photo-1505576399279-565b52d4ac71?q=80&w=600&auto=format&fit=crop',
        'target' => 'Glucose Stability',
        'duration' => '30 Days',
        'summary' => 'Simple food swaps and meal pairing guidelines designed to prevent postprandial blood sugar spikes and stabilize insulin production.',
        'tool_title' => 'Glucose-Friendly Swap Finder',
        'tool_desc' => 'Interactive low-glycemic ingredient swap card.',
        'tool_type' => 'swaps',
        'timeline' => [
            ['time' => 'Morning', 'action' => '<a href="#" class="breathing-link" onclick="openVideoModal(\'https://www.youtube-nocookie.com/embed/1v3uJ_Y2U3E\', event)">Low Glycemic Avocado Toast Recipe</a>', 'desc' => 'Oatmeal with chia seeds, boiled eggs, and cucumber slices.'],
            ['time' => 'Lunch', 'action' => 'Complex Carb Plate', 'desc' => 'Lentil soup served with grilled chicken and mixed green salad.'],
            ['time' => 'Snack', 'action' => 'Glucose Neutral Snack', 'desc' => 'Celery sticks with almond butter.'],
            ['time' => 'Dinner', 'action' => 'Low-GI Evening Meal', 'desc' => 'Pan-seared salmon with steamed green beans and cauliflower mash.']
        ],
        'checklist' => [
            'Paired carbohydrates with protein or healthy fats',
            'Replaced white bread/rice with whole grain or legume options',
            'Took a 10-minute walk after lunch and dinner',
            'Avoided hidden sugars in sauces and dressings'
        ]
    ],
    'AB-C2-01' => [
        'title' => 'Type 2 Diabetes Control',
        'category' => 'Condition Control Plans',
        'badge_class' => 'badge-orange',
        'image' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?q=80&w=600&auto=format&fit=crop',
        'target' => 'HbA1c Reduction',
        'duration' => '45 Days',
        'summary' => 'Therapeutic meal protocol focused on low-glycemic index foods, high soluble fiber, and controlled carbohydrate distribution.',
        'tool_title' => 'Mindful Slow-Eating Pacing',
        'tool_desc' => 'Follow the visual timer to spread digestion evenly over time.',
        'tool_type' => 'pacing',
        'timeline' => [
            ['time' => 'Breakfast', 'action' => 'Protein & Veggie Start', 'desc' => 'Egg omelet with spinach, mushrooms, and avocado slices.'],
            ['time' => 'Lunch', 'action' => '<a href="#" class="breathing-link" onclick="openVideoModal(\'https://www.youtube-nocookie.com/embed/YpXq4j1P6l0\', event)">Diabetic Friendly Meal Preparation</a>', 'desc' => 'Grilled fish, leafy green salad with olive oil, brown lentils, and cinnamon tea.'],
            ['time' => 'Snack', 'action' => 'Raw Nut Snack', 'desc' => 'Small handful of raw walnuts and pumpkin seeds.'],
            ['time' => 'Dinner', 'action' => 'Lean Protein Plate', 'desc' => 'Baked turkey fillet with steamed broccoli and zucchini.']
        ],
        'checklist' => [
            'Monitored glucose levels as directed by healthcare provider',
            'Completed light movement after main meals',
            'Drank cinnamon tea or lemon water post-lunch',
            'Stuck strictly to low-GI carb sources'
        ]
    ],
    'AB-C1-03' => [
        'title' => 'Saturated Fat Reduction',
        'category' => 'Condition Control Plans',
        'badge_class' => 'badge-orange',
        'image' => 'https://images.unsplash.com/photo-1467003909585-2f8a72700288?q=80&w=600&auto=format&fit=crop',
        'target' => 'Clean Lipid Profile',
        'duration' => '30 Days',
        'summary' => 'Gentle transition plan eliminating hidden saturated fats, prioritizing monounsaturated plant oils, and replacing fatty meats.',
        'tool_title' => 'Healthy Oil & Fat Swaps',
        'tool_desc' => 'Check which saturated fats can be substituted with healthy monounsaturated alternatives.',
        'tool_type' => 'swaps',
        'timeline' => [
            ['time' => 'Morning', 'action' => 'Plant-Based Breakfast', 'desc' => 'Overnight oats with chia seeds, soy milk, and sliced berries.'],
            ['time' => 'Lunch', 'action' => '<a href="#" class="breathing-link" onclick="openVideoModal(\'https://www.youtube-nocookie.com/embed/x8s4A3W_1-s\', event)">Olive Oil & Steamed Fish Cooking Guide</a>', 'desc' => 'Steamed white fish, extra virgin olive oil salad dressing, and berries.'],
            ['time' => 'Snack', 'action' => 'Heart Snack', 'desc' => 'Raw almonds and an orange.'],
            ['time' => 'Dinner', 'action' => 'Legume Power Bowl', 'desc' => 'Chickpea and spinach stew served with brown rice.']
        ],
        'checklist' => [
            'Used Extra Virgin Olive Oil instead of butter or cream',
            'Chose lean white fish or plant protein over red meat',
            'Checked food labels for zero trans fats and low saturated fats',
            'Included soluble fiber sources in at least 2 meals'
        ]
    ],
    'AB-C2-03' => [
        'title' => 'Lipid Balance & Heart Health',
        'category' => 'Condition Control Plans',
        'badge_class' => 'badge-orange',
        'image' => 'https://images.unsplash.com/photo-1543339308-43e59d6b73a6?q=80&w=600&auto=format&fit=crop',
        'target' => 'Cholesterol Optimization',
        'duration' => '45 Days',
        'summary' => 'Intensive heart-healthy protocol rich in soluble fiber, plant sterols, and omega-3 essential fatty acids.',
        'tool_title' => 'Daily Hydration & Flush Tracker',
        'tool_desc' => 'Interactive water cup tracker to ensure daily cellular hydration.',
        'tool_type' => 'water',
        'timeline' => [
            ['time' => 'Breakfast', 'action' => 'Beta-Glucan Starter', 'desc' => 'Oats with flaxseed, chia seeds, and fresh berries.'],
            ['time' => 'Lunch', 'action' => '<a href="#" class="breathing-link" onclick="openVideoModal(\'https://www.youtube-nocookie.com/embed/2_mP_e_vVd8\', event)">Omega-3 Rich Salmon Salad Recipe</a>', 'desc' => 'Grilled wild salmon served over avocado and mixed green salad.'],
            ['time' => 'Snack', 'action' => 'Sterol Snack', 'desc' => 'Handful of unsalted walnuts and green tea.'],
            ['time' => 'Dinner', 'action' => 'Cardio-Protective Plate', 'desc' => 'Black bean patty with roasted vegetables and quinoa.']
        ],
        'checklist' => [
            'Consumed 2 tablespoons of ground flaxseeds or chia seeds',
            'Ate fatty fish (salmon, sardines) or plant omega-3 source',
            'Avoided fried foods and commercial baked goods',
            'Drank 2 cups of antioxidant-rich green tea'
        ]
    ],

    // ---------------- ROJOS: ADVANCED & INTENSIVE PLANS ----------------
    'AB-A3-01' => [
        'title' => 'Athletic Performance & Recovery',
        'category' => 'Advanced & Intensive Plans',
        'badge_class' => 'badge-red',
        'image' => 'https://images.unsplash.com/photo-1517838277536-f5f99be501cd?q=80&w=600&auto=format&fit=crop',
        'target' => 'Athletic Support',
        'duration' => '60 Days',
        'summary' => 'High nutrient-density plan tailored for heavy athletic training, optimizing glycogen restoration and tissue repair.',
        'tool_title' => 'Post-Workout Hydration Counter',
        'tool_desc' => 'Interactive fluid logger for athlete recovery.',
        'tool_type' => 'water',
        'timeline' => [
            ['time' => 'Pre-Training', 'action' => 'Fast Carbs & Hydration', 'desc' => 'Oat flakes with honey and clean electrolyte drink.'],
            ['time' => 'Post-Training', 'action' => 'Anabolic Window', 'desc' => 'Whey protein isolate shake with tart cherry juice.'],
            ['time' => 'Main Recovery Meal', 'action' => '<a href="#" class="breathing-link" onclick="openVideoModal(\'https://www.youtube-nocookie.com/embed/v3R2g85HwMo\', event)">High-Protein Steak & Sweet Potato Prep</a>', 'desc' => 'Lean steak, roasted sweet potato, steamed broccoli, and chia pudding.'],
            ['time' => 'Night Rest', 'action' => 'Casein & Anti-Inflammatory', 'desc' => 'Cottage cheese or casein protein with turmeric tea before bed.']
        ],
        'checklist' => [
            'Consumed recovery shake within 30 minutes post-workout',
            'Hit daily high-protein goal for muscle repair',
            'Included tart cherry or turmeric for joint recovery',
            'Maintained peak hydration with electrolytes'
        ]
    ],
    'AB-A3-02' => [
        'title' => 'Advanced Body Composition',
        'category' => 'Advanced & Intensive Plans',
        'badge_class' => 'badge-red',
        'image' => 'https://images.unsplash.com/photo-1532550907401-a500c9a57435?q=80&w=600&auto=format&fit=crop',
        'target' => 'Body Recomposition',
        'duration' => '60 Days',
        'summary' => 'Precision carbohydrate cycling and high-protein allocation engineered for simultaneous fat loss and lean tissue development.',
        'tool_title' => 'Meal Pacing Timer for Recomp',
        'tool_desc' => 'Progressive bar timer to optimize eating pace.',
        'tool_type' => 'pacing',
        'timeline' => [
            ['time' => 'Meal 1', 'action' => 'Protein & Healthy Fats', 'desc' => 'Seared tuna steak or egg whites with avocado.'],
            ['time' => 'Meal 2 (Post-Workout)', 'action' => '<a href="#" class="breathing-link" onclick="openVideoModal(\'https://www.youtube-nocookie.com/embed/S_8S3-Hl1a0\', event)">Bodybuilding Rice & Chicken Prep</a>', 'desc' => 'Jasmine rice with grilled chicken breast and green beans.'],
            ['time' => 'Meal 3', 'action' => 'Micronutrient Refuel', 'desc' => 'Sautéed kale, pumpkin seeds, seared tuna, and green tea.'],
            ['time' => 'Meal 4', 'action' => 'Slow Digesting Protein', 'desc' => 'Baked cod with asparagus and olive oil.']
        ],
        'checklist' => [
            'Adhered strictly to High/Low Carb day assignments',
            'Weighed all food portions accurately',
            'Drank 3+ Liters of water throughout the day',
            'Avoided all non-plan cheat meals'
        ]
    ],
    'AB-A3-03' => [
        'title' => 'Advanced Insulin Sensitivity',
        'category' => 'Advanced & Intensive Plans',
        'badge_class' => 'badge-red',
        'image' => 'https://images.unsplash.com/photo-1547592180-85f173990554?q=80&w=600&auto=format&fit=crop',
        'target' => 'Long-Term Stability',
        'duration' => '60 Days',
        'summary' => 'Strict low-glycemic load clinical protocol engineered to maximize insulin receptor sensitivity.',
        'tool_title' => 'Low-Glycemic Swap Finder',
        'tool_desc' => 'Interactive food substitution board.',
        'tool_type' => 'swaps',
        'timeline' => [
            ['time' => 'Breakfast', 'action' => 'Zero-Spike Breakfast', 'desc' => 'Avocado bowl with poached eggs and raw almonds.'],
            ['time' => 'Lunch', 'action' => '<a href="#" class="breathing-link" onclick="openVideoModal(\'https://www.youtube-nocookie.com/embed/1v3uJ_Y2U3E\', event)">Low Carb Fish & Green Veggies Recipe</a>', 'desc' => 'Baked cod, sautéed kale, bell peppers, and extra virgin olive oil.'],
            ['time' => 'Afternoon', 'action' => 'Metabolic Tea', 'desc' => 'Matcha green tea with apple cider vinegar water.'],
            ['time' => 'Dinner', 'action' => 'Fiber & Lean Protein', 'desc' => 'Grilled wild cod or tofu with broccoli florets and raw almonds.']
        ],
        'checklist' => [
            'Kept total net carb intake within strict target limits',
            'Drank apple cider vinegar dilution prior to main meals',
            'Zero consumption of processed sugars or refined grains',
            'Logged all meals and post-meal energy responses'
        ]
    ]
];

$plan = $planes[$planId] ?? $planes['AB-G1-01'];
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
        /* Estilos dinámicos para los nuevos componentes interactivos */
        .interactive-box-wrapper {
            background: #ffffff;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            border: 1px solid #e2e8f0;
            margin-top: 15px;
        }

        /* Estilo 1: Pacing Timer (Barra) */
        .pacing-container {
            text-align: center;
        }
        .pacing-bar-bg {
            background: #e2e8f0;
            height: 24px;
            border-radius: 12px;
            overflow: hidden;
            margin: 20px 0;
            position: relative;
        }
        .pacing-bar-fill {
            height: 100%;
            width: 0%;
            background: linear-gradient(90deg, #10b981, #3b82f6);
            transition: width 0.3s linear;
        }
        .pacing-status {
            font-size: 1.2rem;
            font-weight: 700;
            color: #1e293b;
        }

        /* Estilo 2: Water Glass Counter Grid */
        .water-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin: 20px 0;
        }
        .water-glass-card {
            background: #f1f5f9;
            border: 2px solid #cbd5e1;
            border-radius: 12px;
            padding: 15px 10px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .water-glass-card.filled {
            background: #e0f2fe;
            border-color: #0284c7;
            color: #0284c7;
        }
        .water-glass-card i {
            font-size: 1.8rem;
            display: block;
            margin-bottom: 5px;
        }

        /* Estilo 3: Food Swap Interactive Board */
        .swap-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-top: 15px;
        }
        .swap-item-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #f8fafc;
            padding: 14px 18px;
            border-radius: 10px;
            border-left: 5px solid #ef4444;
            transition: all 0.3s ease;
        }
        .swap-item-card.swapped {
            border-left-color: #10b981;
            background: #f0fdf4;
        }
        .btn-swap-toggle {
            background: #0f172a;
            color: #fff;
            border: none;
            padding: 6px 14px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.85rem;
        }
        <style>
    /* Estilos base claros */
    .interactive-box-wrapper {
        background: #ffffff;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        border: 1px solid #e2e8f0;
        margin-top: 15px;
        transition: background 0.3s ease, border-color 0.3s ease;
    }

    .pacing-container {
        text-align: center;
    }
    .pacing-bar-bg {
        background: #e2e8f0;
        height: 24px;
        border-radius: 12px;
        overflow: hidden;
        margin: 20px 0;
        position: relative;
    }
    .pacing-bar-fill {
        height: 100%;
        width: 0%;
        background: linear-gradient(90deg, #10b981, #3b82f6);
        transition: width 0.3s linear;
    }
    .pacing-status {
        font-size: 1.2rem;
        font-weight: 700;
        color: #1e293b;
    }

    .water-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
        margin: 20px 0;
    }
    .water-glass-card {
        background: #f1f5f9;
        border: 2px solid #cbd5e1;
        border-radius: 12px;
        padding: 15px 10px;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s ease;
        color: #334155;
    }
    .water-glass-card.filled {
        background: #e0f2fe;
        border-color: #0284c7;
        color: #0284c7;
    }
    .water-glass-card i {
        font-size: 1.8rem;
        display: block;
        margin-bottom: 5px;
    }

    .swap-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-top: 15px;
    }
    .swap-item-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #f8fafc;
        padding: 14px 18px;
        border-radius: 10px;
        border-left: 5px solid #ef4444;
        transition: all 0.3s ease;
        color: #1e293b;
    }
    .swap-item-card.swapped {
        border-left-color: #10b981;
        background: #f0fdf4;
    }
    .btn-swap-toggle {
        background: #0f172a;
        color: #fff;
        border: none;
        padding: 6px 14px;
        border-radius: 6px;
        cursor: pointer;
        font-size: 0.85rem;
    }

    /* =========================================================
       SOPORTE PARA MODO OSCURO (Dark Mode Styles)
    ========================================================= */
    body.dark-mode .interactive-box-wrapper,
    body.dark .interactive-box-wrapper {
        background: #1e1e1e !important;
        border-color: #333333 !important;
        color: #f1f5f9 !important;
        box-shadow: 0 10px 25px rgba(0,0,0,0.3) !important;
    }

    body.dark-mode .interactive-box-wrapper h3,
    body.dark .interactive-box-wrapper h3 {
        color: #ffffff !important;
    }

    body.dark-mode .interactive-box-wrapper p,
    body.dark .interactive-box-wrapper p {
        color: #94a3b8 !important;
    }

    body.dark-mode .pacing-status,
    body.dark .pacing-status {
        color: #ffffff !important;
    }

    body.dark-mode .pacing-bar-bg,
    body.dark .pacing-bar-bg {
        background: #334155 !important;
    }

    /* Vasos de Agua Modo Oscuro */
    body.dark-mode .water-glass-card,
    body.dark .water-glass-card {
        background: #2a2a2a !important;
        border-color: #444444 !important;
        color: #cbd5e1 !important;
    }

    body.dark-mode .water-glass-card.filled,
    body.dark .water-glass-card.filled {
        background: #0c4a6e !important;
        border-color: #38bdf8 !important;
        color: #38bdf8 !important;
    }

    /* Tarjetas Swap Modo Oscuro */
    body.dark-mode .swap-item-card,
    body.dark .swap-item-card {
        background: #262626 !important;
        color: #f1f5f9 !important;
    }

    body.dark-mode .swap-item-card.swapped,
    body.dark .swap-item-card.swapped {
        background: #064e3b !important;
    }

    body.dark-mode .btn-swap-toggle,
    body.dark .btn-swap-toggle {
        background: #334155 !important;
        color: #ffffff !important;
    }
</style>
    </style>
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
            <a href="catalogo.php" class="back-btn">
                <i class="fa-solid fa-arrow-left"></i> Back to Catalog
            </a>

            <!-- Header Banner -->
            <div class="hero-banner">
                <img src="<?= htmlspecialchars($plan['image']) ?>" alt="<?= htmlspecialchars($plan['title']) ?>">
                <div class="hero-overlay">
                    <span class="badge-code <?= $plan['badge_class'] ?>"><?= htmlspecialchars($planId) ?></span>
                    <h1><?= htmlspecialchars($plan['title']) ?></h1>
                    <p><?= htmlspecialchars($plan['category']) ?></p>
                    <div class="protocol-meta">
                        <span class="meta-tag"><i class="fa-solid fa-bullseye"></i> Target: <?= htmlspecialchars($plan['target']) ?></span>
                        <span class="meta-tag"><i class="fa-regular fa-calendar"></i> Duration: <?= htmlspecialchars($plan['duration']) ?></span>
                    </div>
                </div>
            </div>

            <!-- Overview -->
            <p class="protocol-summary">
                <?= htmlspecialchars($plan['summary']) ?>
            </p>

            <!-- Herramienta Interactiva Directa (Sin Modal Único) -->
            <h2 class="section-title"><i class="fa-solid fa-utensils"></i> Interactive Nutrition Tool</h2>
            <div class="interactive-box-wrapper">
                <h3 style="margin-bottom: 5px;"><?= htmlspecialchars($plan['tool_title']) ?></h3>
                <p style="font-size: 0.9rem; color: #64748b;"><?= htmlspecialchars($plan['tool_desc']) ?></p>

                <?php if ($plan['tool_type'] === 'pacing'): ?>
                    <!-- Componente Visual 1: Timer de Barra Animada -->
                    <div class="pacing-container">
                        <div class="pacing-bar-bg">
                            <div id="pacingFill" class="pacing-bar-fill"></div>
                        </div>
                        <div id="pacingStatus" class="pacing-status">Ready to start</div>
                        <button type="button" class="btn-start-breathing" style="margin-top: 15px;" onclick="startPacingBar()">
                            <i class="fa-solid fa-play"></i> Start Chewing Rhythm
                        </button>
                    </div>

                <?php elseif ($plan['tool_type'] === 'water'): ?>
                    <!-- Componente Visual 2: Grid de Vasos de Agua -->
                    <div>
                        <div class="water-grid">
                            <?php for($i = 1; $i <= 8; $i++): ?>
                                <div class="water-glass-card" onclick="toggleGlass(this)">
                                    <i class="fa-solid fa-glass-water"></i>
                                    <span style="font-size: 0.8rem; font-weight: 600;">Glass <?= $i ?></span>
                                </div>
                            <?php endfor; ?>
                        </div>
                        <p style="text-align: center; font-weight: bold; color: #0284c7;" id="waterTrackerText">0 of 8 Glasses Drank Today</p>
                    </div>

                <?php elseif ($plan['tool_type'] === 'swaps'): ?>
                    <!-- Componente Visual 3: Tarjetas Interactivas de Sustitución -->
                    <div class="swap-list">
                        <div class="swap-item-card" id="swap1">
                            <div>
                                <span class="badge-code badge-red" style="font-size: 0.7rem;">ORIGINAL</span>
                                <strong id="orig1" style="margin-left: 5px;">White Rice / Processed Carbs</strong>
                            </div>
                            <button class="btn-swap-toggle" onclick="toggleSwap('swap1', 'orig1', 'Quinoa / Cauliflower Rice')">Swap Item</button>
                        </div>

                        <div class="swap-item-card" id="swap2">
                            <div>
                                <span class="badge-code badge-red" style="font-size: 0.7rem;">ORIGINAL</span>
                                <strong id="orig2" style="margin-left: 5px;">Butter & Animal Fats</strong>
                            </div>
                            <button class="btn-swap-toggle" onclick="toggleSwap('swap2', 'orig2', 'Extra Virgin Olive Oil')">Swap Item</button>
                        </div>

                        <div class="swap-item-card" id="swap3">
                            <div>
                                <span class="badge-code badge-red" style="font-size: 0.7rem;">ORIGINAL</span>
                                <strong id="orig3" style="margin-left: 5px;">Sugary Sodas & Sauces</strong>
                            </div>
                            <button class="btn-swap-toggle" onclick="toggleSwap('swap3', 'orig3', 'Infused Lemon Water & Spices')">Swap Item</button>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Step-by-Step Meal Protocol -->
            <h2 class="section-title"><i class="fa-solid fa-clock-rotate-left"></i> Daily Meal & Nutrition Protocol</h2>
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
            <h2 class="section-title"><i class="fa-solid fa-square-check"></i> Daily Nutrition Checklist</h2>
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

    <!-- Modal Emergente Mediano para Videos / Recetas con No-Cookie Player -->
    <div id="videoModal" class="modal-overlay">
        <div class="modal-content" style="max-width: 650px; width: 90%; padding: 20px; text-align: center;">
            <button class="close-modal" onclick="closeVideoModal()">&times;</button>
            <h3 style="margin-bottom: 15px;">Recipe & Cooking Video Tutorial</h3>
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

            <div class="access-item" role="button" onclick="speakText()">
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

    <script src="js/script.js"></script>
    <script src="js/asistente.js"></script>
    <script>
        // Modal de Video con soporte para rel=0 y no-cookie
        function openVideoModal(embedUrl, e) {
            if (e) e.preventDefault();
            const videoIframe = document.getElementById('videoIframe');
            videoIframe.src = embedUrl + "?autoplay=1&rel=0";
            document.getElementById('videoModal').style.display = 'flex';
        }

        function closeVideoModal() {
            const videoIframe = document.getElementById('videoIframe');
            videoIframe.src = "";
            document.getElementById('videoModal').style.display = 'none';
        }

        // Lógica del Temporizador de Pacing (Barra)
        let pacingActive = false;
        function startPacingBar() {
            if (pacingActive) return;
            pacingActive = true;

            const fill = document.getElementById('pacingFill');
            const status = document.getElementById('pacingStatus');
            let step = 0;

            function runCycle() {
                if (step === 0) {
                    status.innerText = "1. Bite Food (Slowly)";
                    fill.style.width = "25%";
                    fill.style.background = "#10b981";
                    step = 1;
                    setTimeout(runCycle, 3000);
                } else if (step === 1) {
                    status.innerText = "2. Chew Thoroughly (20 Seconds)";
                    fill.style.width = "85%";
                    fill.style.background = "#3b82f6";
                    step = 2;
                    setTimeout(runCycle, 8000);
                } else {
                    status.innerText = "3. Swallow & Pause";
                    fill.style.width = "100%";
                    fill.style.background = "#f59e0b";
                    step = 0;
                    setTimeout(() => {
                        fill.style.width = "0%";
                        pacingActive = false;
                        status.innerText = "Cycle Complete! Click to start next bite.";
                    }, 3000);
                }
            }
            runCycle();
        }

        // Lógica de Contación de Agua en Grid
        function toggleGlass(element) {
            element.classList.toggle('filled');
            const count = document.querySelectorAll('.water-glass-card.filled').length;
            document.getElementById('waterTrackerText').innerText = `${count} of 8 Glasses Drank Today`;
        }

        // Lógica de Swaps
        function toggleSwap(cardId, textId, newText) {
            const card = document.getElementById(cardId);
            const textElem = document.getElementById(textId);
            
            if (card.classList.contains('swapped')) {
                card.classList.remove('swapped');
                card.querySelector('.badge-code').className = "badge-code badge-red";
                card.querySelector('.badge-code').innerText = "ORIGINAL";
            } else {
                card.classList.add('swapped');
                card.querySelector('.badge-code').className = "badge-code badge-green";
                card.querySelector('.badge-code').innerText = "HEALTHY SWAP";
                textElem.innerText = newText;
            }
        }
    </script>

</body>
</html>