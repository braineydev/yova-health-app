<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HealthCalc Pro | Bento Edition</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <div class="container py-4 py-lg-5">
        <header class="d-flex justify-content-between align-items-center mb-5">
            <h2 class="fw-bold m-0 text-white tracking-tight">Yova<span class="text-accent">Health</span></h2>
            <div class="user-avatar">
                <i class="bi bi-person-fill"></i>
            </div>
        </header>

        <div class="print-header d-none mb-4 pb-2 border-bottom">
            <div class="print-logo">
                Yova<span class="text-accent">Health</span>
            </div>
            <p class="print-subtitle">Printable BMI Report</p>
            <div class="d-flex flex-wrap align-items-center gap-3">
                <p class="print-category mb-0" id="printCategory">BMI Category: --</p>
                <p class="print-date mb-0" id="printDate">Date: --</p>
            </div>
        </div>

        <div class="row g-4 bento-grid">
            <div class="col-lg-5">
                <div class="bento-card p-4 p-md-5 h-100 d-flex flex-column">
                    <div class="mb-4">
                        <h1 class="display-6 fw-bold text-white mb-1">Calculate</h1>
                        <p class="text-secondary">Enter your metrics below.</p>
                    </div>

                    <form id="bmiForm" class="flex-grow-1 d-flex flex-column justify-content-between" novalidate>
                        <div>
                            <div class="bento-input-group mb-3">
                                <label>Full Name (Optional)</label>
                                <input type="text" class="form-control" name="name" placeholder="e.g., Ethan">
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-6">
                                    <div class="bento-input-group">
                                        <label>Gender</label>
                                        <select class="form-select" name="gender" required>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Prefer not to say">Prefer not to say</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bento-input-group">
                                        <label>Age</label>
                                        <input type="number" class="form-control" name="age" min="2" max="120" required placeholder="22">
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-6">
                                    <div class="bento-input-group">
                                        <label>Height</label>
                                        <div class="input-group">
                                            <input type="number" step="0.01" class="form-control" name="height" required placeholder="175">
                                            <select class="form-select" name="height_unit" style="max-width: 80px;">
                                                <option value="cm">cm</option>
                                                <option value="m">m</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bento-input-group">
                                        <label>Weight (kg)</label>
                                        <input type="number" step="0.1" class="form-control" name="weight" max="500" required placeholder="70">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-accent w-100 py-3 fw-bold rounded-pill mt-4">
                            Analyze Metrics <i class="bi bi-arrow-right ms-2"></i>
                        </button>
                    </form>
                </div>
            </div>

            <div class="col-lg-7" id="resultsContainer" style="opacity: 0.3; pointer-events: none; transition: opacity 0.5s;">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bento-card p-4 p-md-5 position-relative overflow-hidden">
                            <div class="d-flex justify-content-between align-items-start mb-4">
                                <div>
                                    <p class="text-secondary mb-1" id="welcomeUser">Awaiting Input...</p>
                                    <h2 class="display-3 fw-bold text-white m-0" id="resBmi">--</h2>
                                    <p class="text-secondary small mt-2 mb-0" id="currentDateLabel">Date: --</p>
                                </div>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="status-badge" id="statusBadge">Standby</div>
                                    <button type="button" id="printButton" class="btn btn-print btn-sm d-none">
                                        Print Results
                                    </button>
                                </div>
                            </div>

                            <div class="mt-5 pt-3">
                                <div class="d-flex justify-content-between text-secondary small mb-2 fw-bold" style="font-size: 0.75rem; letter-spacing: 1px; text-transform: uppercase;">
                                    <span>Under</span>
                                    <span>Normal</span>
                                    <span>Over</span>
                                    <span>Obese</span>
                                </div>
                                <div class="bento-scale-track">
                                    <div class="bento-scale-marker" id="bmiMarker"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="bento-card p-4 h-100" id="nutritionCard">
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-box bg-accent text-dark me-3"><i class="bi bi-apple"></i></div>
                                <h5 class="fw-bold text-white m-0">Nutrition</h5>
                            </div>
                            <ul class="text-secondary small list-unstyled lh-lg mb-4" id="nutritionList">
                                <li>Submit your details to receive a customized nutrition plan.</li>
                            </ul>
                            <p class="text-white small fw-bold mb-1">Target Foods:</p>
                            <p class="text-secondary small m-0" id="foodList">--</p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="bento-card p-4 h-100">
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-box bg-white text-dark me-3"><i class="bi bi-heart-pulse-fill"></i></div>
                                <h5 class="fw-bold text-white m-0">Daily Goals</h5>
                            </div>
                            <div class="d-flex flex-column gap-3 mt-4">
                                <div class="task-item">
                                    <i class="bi bi-droplet-fill text-accent"></i>
                                    <span class="text-secondary small">Drink 2–3 liters of water</span>
                                </div>
                                <div class="task-item">
                                    <i class="bi bi-moon-stars-fill text-accent"></i>
                                    <span class="text-secondary small">Sleep 7–9 hours</span>
                                </div>
                                <div class="task-item">
                                    <i class="bi bi-activity text-accent"></i>
                                    <span class="text-secondary small">30 mins active movement</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="print-report print-only d-none">
        <div class="print-summary p-4 mb-4 rounded-4 border">
            <div class="d-flex flex-wrap justify-content-between align-items-start gap-4">
                <div>
                    <div class="print-logo">Yova<span class="text-accent">Health</span></div>
                    <p class="print-subtitle">Printable BMI Report</p>
                </div>
                <div class="text-end">
                    <p class="print-category mb-1" id="printCategoryAlt">BMI Category: --</p>
                    <p class="print-date mb-0" id="printDateAlt">Date: --</p>
                </div>
            </div>
            <div class="print-big-card mt-4 p-4 rounded-4 border">
                <div class="d-flex flex-wrap justify-content-between align-items-start gap-4">
                    <div>
                        <p class="print-hero-label mb-1">Patient :  <span id="printName">User</span></p>
                        <h1 class="print-hero-bmi" id="printBmi">--</h1>
                    </div>
                    <div class="status-badge print-status" id="printStatus">--</div>
                </div>
            </div>
        </div>
        <div class="print-cards d-flex flex-wrap gap-4">
            <div class="print-card print-nutrition p-4 rounded-4 border">
                <h3>Nutrition</h3>
                <ul id="printNutritionList"></ul>
                <p class="print-card-phrase mt-3"><strong>Target Foods:</strong> <span id="printFoods">--</span></p>
            </div>
            <div class="print-card print-goals p-4 rounded-4 border">
                <h3>Daily Goals</h3>
                <ul id="printGoalsList"></ul>
            </div>
        </div>
        <div class="print-footer mt-4 text-center">
            © 2026 YovaHealth. All rights reserved.
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>
