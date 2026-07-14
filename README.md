YOVA HEALTH

YovaHealth (HealthCalc Pro) - Bento Edition
A premium, high-contrast, fully responsive Body Mass Index (BMI) Calculator and Nutrition Recommendation Web Application.

Unlike standard clinical calculators, YovaHealth employs a state-of-the-art Bento Box UI and a High-Contrast Dark Mode aesthetic to deliver health metrics in a visually stunning, highly tactile, and easily digestible format.

Built with a seamless, zero-refresh architecture, the application communicates with a robust PHP backend via the Vanilla JavaScript Fetch API, delivering instantaneous, personalized health insights.

Key Features
Premium Bento Box Layout: Information is segmented into beautifully rounded, distinct modules utilizing generous whitespace and spatial hierarchy for maximum scannability.

High-Contrast Dark Mode: A deep, matte-black aesthetic paired with highly saturated, energetic accent colors (Zero blue standard Bootstrap styling).

Zero-Refresh Interactivity: Powered by asynchronous JavaScript (fetch), ensuring the user never experiences a jarring page reload.

Dynamic Visual BMI Scale: Features a custom-built, multi-color gradient track with a mathematically precise, animated marker that clamps perfectly to the user's calculated BMI.

Personalized Nutrition Engine: Automatically curates a customized nutrition plan and target food list based on official WHO BMI categorizations (Underweight, Normal, Overweight, Obese).

Client & Server-Side Validation: Dual-layer security ensures unrealistic human measurements (e.g., 500kg weight) or malicious inputs are intercepted instantly.

Fully Responsive: Flawless rendering across mobile, tablet, and desktop viewports without breaking the bento-grid structure.

Technology Stack
Frontend: HTML5, CSS3 (Custom Variables, Flexbox/Grid), Vanilla JavaScript (ES6)

Backend: PHP 8+ (Data validation, WHO calculation logic, JSON response generation)

Framework: Bootstrap 5 (Utilized strictly for grid structures and utility classes, with default theming heavily overridden)

Iconography: Bootstrap Icons (bootstrap-icons.css)

Project Structure
Plaintext
/yova-health-bmi
│
├── index.php             # Core UI, layout, and frontend structure
├── process.php           # Secure backend logic, validation, and JSON API
│
├── assets/
│   ├── css/
│   │   └── style.css     # Premium dark mode, bento UI, and scale animations
│   │
│   └── js/
│       └── script.js     # Async form submission, data population, marker math
│
└── README.md             # Project documentation
Installation & Setup
Because this application relies on a PHP backend to process the BMI calculations securely, it must be run on a local or remote web server.

1. Local Environment Requirements
Ensure you have a local server environment installed. Popular options include:

XAMPP (Windows/Mac/Linux)

MAMP (Mac/Windows)

Laragon (Windows)

Docker (For advanced users)

2. Deployment Steps
Start your local server: Open XAMPP/MAMP and start the Apache service.

Navigate to the web root:

XAMPP: Go to C:\xampp\htdocs\

MAMP: Go to /Applications/MAMP/htdocs/

Create the project folder: Create a new folder named yovahealth.

Add the files: Place index.php, process.php, and the assets folder inside the yovahealth directory.

Run the application: Open your web browser and navigate to http://localhost/yovahealth.

Usage Guide
Enter Metrics: On the left-hand side "Calculate" card, enter an optional name, gender, age, height (in cm or m), and weight (in kg).

Analyze: Click the Analyze Metrics button.

View Results:

The right-hand bento grid will smoothly fade in.

Your precise BMI score will be displayed alongside your health status (e.g., Normal, Overweight).

The glowing visual marker will spring into place on the gradient scale, pinpointing exactly where your score falls.

Review Plan: Read your tailored daily goals and recommended target foods dynamically generated in the bottom modules.

UI/UX Design Principles Applied
This project was built following strict modern design mandates:

Typography as UI: Oversized, variable-weight fonts (Inter) establish a strict visual hierarchy.

Tactile Affordance: Soft inner shadows, massive touch targets, and hover states make the interface feel tangible.

Color Psychology: Specific colors (#D946EF for Underweight, #10B981 for Normal, #F59E0B for Overweight, #EF4444 for Obese) are used to visually communicate health statuses instantly without relying on text alone.

Security Measures
Sanitization: htmlspecialchars() and strip_tags() protect against Cross-Site Scripting (XSS).

Type Casting: filter_var() strictly enforces integer and float types.

Boundary Checking: Backend immediately halts and returns error JSON if submitted values fall outside realistic human physiological limits.

Developed as a showcase of modern UI/UX engineering combined with secure, modular backend processing.
