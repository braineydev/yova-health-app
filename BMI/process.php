<?php
error_reporting(0);
ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars(strip_tags($_POST['name'] ?? ''));
    $gender = htmlspecialchars($_POST['gender'] ?? '');
    $age = filter_var($_POST['age'] ?? null, FILTER_VALIDATE_INT);
    $height = filter_var($_POST['height'] ?? null, FILTER_VALIDATE_FLOAT);
    $heightUnit = htmlspecialchars($_POST['height_unit'] ?? 'cm');
    $weight = filter_var($_POST['weight'] ?? null, FILTER_VALIDATE_FLOAT);

    if (!$age || $age < 2 || $age > 120 || !$height || $height <= 0 || !$weight || $weight <= 0) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid numeric inputs provided.']);
        exit;
    }

    $heightInMeters = ($heightUnit === 'cm') ? $height / 100 : $height;

    if ($weight > 500 || $heightInMeters > 3 || $heightInMeters < 0.4) {
        echo json_encode(['status' => 'error', 'message' => 'Values are out of realistic human ranges.']);
        exit;
    }

    $bmi = round($weight / ($heightInMeters * $heightInMeters), 2);

    if ($bmi < 18.5) {
        $category = 'Underweight';
        $color = '#D946EF';
        $nutrition = ['Increase calorie intake.', 'Eat healthy carbohydrates.', 'Consume protein-rich foods.', 'Exercise for muscle gain.'];
        $foods = 'Chicken, Eggs, Milk, Rice, Beans, Avocados.';
    } elseif ($bmi >= 18.5 && $bmi <= 24.9) {
        $category = 'Normal Weight';
        $color = '#10B981';
        $nutrition = ['Maintain a balanced diet.', 'Eat vegetables.', 'Exercise regularly.', 'Avoid excessive sugar.'];
        $foods = 'Fish, Chicken, Fruits, Vegetables, Whole grains.';
    } elseif ($bmi >= 25 && $bmi <= 29.9) {
        $category = 'Overweight';
        $color = '#F59E0B';
        $nutrition = ['Reduce sugary foods.', 'Avoid soft drinks.', 'Exercise 30–60 minutes daily.', 'Increase vegetables.'];
        $foods = 'Broccoli, Spinach, Brown rice, Chicken breast, Oats.';
    } else {
        $category = 'Obese';
        $color = '#EF4444';
        $nutrition = ['Consult a healthcare professional.', 'Reduce processed foods.', 'Control portions.', 'Increase dietary fiber.'];
        $foods = 'Vegetables, Salads, Whole grains, Fish, Low-fat yogurt.';
    }

    echo json_encode([
        'status' => 'success',
        'data' => [
            'name' => $name ?: 'User',
            'bmi' => $bmi,
            'category' => $category,
            'color' => $color,
            'nutrition' => $nutrition,
            'foods' => $foods,
        ],
    ]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
