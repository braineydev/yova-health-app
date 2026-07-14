document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("bmiForm");
  const resultsContainer = document.getElementById("resultsContainer");
  const printButton = document.getElementById("printButton");

  function formatDisplayDate(date = new Date()) {
    return date.toLocaleDateString("en-US", {
      month: "long",
      day: "numeric",
      year: "numeric",
    });
  }

  function updateDateDisplays() {
    const formattedDate = formatDisplayDate();
    const currentDateLabel = document.getElementById("currentDateLabel");
    const printDate = document.getElementById("printDate");
    const printDateAlt = document.getElementById("printDateAlt");

    if (currentDateLabel) {
      currentDateLabel.textContent = `Date: ${formattedDate}`;
    }
    if (printDate) {
      printDate.textContent = `Date: ${formattedDate}`;
    }
    if (printDateAlt) {
      printDateAlt.textContent = `Date: ${formattedDate}`;
    }
  }

  updateDateDisplays();
  if (printButton) {
    printButton.addEventListener("click", () => window.print());
  }

  form.addEventListener("submit", function (e) {
    e.preventDefault();

    if (!form.checkValidity()) {
      e.stopPropagation();
      form.classList.add("was-validated");
      return;
    }

    const formData = new FormData(form);
    const submitButton = form.querySelector('button[type="submit"]');
    const originalText = submitButton.innerHTML;
    submitButton.innerHTML =
      '<span class="spinner-border spinner-border-sm me-2"></span> Processing...';

    const result = calculateBMI(Object.fromEntries(formData.entries()));
    submitButton.innerHTML = originalText;

    if (result.status === "success") {
      populateResults(result.data);
    } else {
      alert(result.message);
    }
  });

  function calculateBMI(values) {
    const name = values.name ? String(values.name).trim() : "User";
    const age = Number(values.age);
    const height = Number(values.height);
    const weight = Number(values.weight);
    const heightUnit = values.height_unit || "cm";

    if (
      !Number.isFinite(age) ||
      age < 2 ||
      age > 120 ||
      !Number.isFinite(height) ||
      height <= 0 ||
      !Number.isFinite(weight) ||
      weight <= 0
    ) {
      return { status: "error", message: "Invalid numeric inputs provided." };
    }

    const heightInMeters = heightUnit === "cm" ? height / 100 : height;

    if (weight > 500 || heightInMeters > 3 || heightInMeters < 0.4) {
      return {
        status: "error",
        message: "Values are out of realistic human ranges.",
      };
    }

    const bmi = Number((weight / (heightInMeters * heightInMeters)).toFixed(2));

    let category = "Obese";
    let color = "#EF4444";
    let nutrition = [
      "Consult a healthcare professional.",
      "Reduce processed foods.",
      "Control portions.",
      "Increase dietary fiber.",
    ];
    let foods = "Vegetables, Salads, Whole grains, Fish, Low-fat yogurt.";

    if (bmi < 18.5) {
      category = "Underweight";
      color = "#D946EF";
      nutrition = [
        "Increase calorie intake.",
        "Eat healthy carbohydrates.",
        "Consume protein-rich foods.",
        "Exercise for muscle gain.",
      ];
      foods = "Chicken, Eggs, Milk, Rice, Beans, Avocados.";
    } else if (bmi >= 18.5 && bmi <= 24.9) {
      category = "Normal Weight";
      color = "#10B981";
      nutrition = [
        "Maintain a balanced diet.",
        "Eat vegetables.",
        "Exercise regularly.",
        "Avoid excessive sugar.",
      ];
      foods = "Fish, Chicken, Fruits, Vegetables, Whole grains.";
    } else if (bmi >= 25 && bmi <= 29.9) {
      category = "Overweight";
      color = "#F59E0B";
      nutrition = [
        "Reduce sugary foods.",
        "Avoid soft drinks.",
        "Exercise 30–60 minutes daily.",
        "Increase vegetables.",
      ];
      foods = "Broccoli, Spinach, Brown rice, Chicken breast, Oats.";
    }

    return {
      status: "success",
      data: {
        name,
        bmi,
        category,
        color,
        nutrition,
        foods,
      },
    };
  }

  function populateResults(data) {
    resultsContainer.style.opacity = "1";
    resultsContainer.style.pointerEvents = "auto";

    document.getElementById("welcomeUser").textContent = `Hello, ${data.name}`;
    const bmiEl = document.getElementById("resBmi");
    bmiEl.textContent = data.bmi;
    bmiEl.style.color = data.color;

    const badge = document.getElementById("statusBadge");
    badge.textContent = data.category;
    badge.style.backgroundColor = data.color;
    badge.style.color = "#000";
    badge.style.opacity = "0.14";
    badge.style.padding = "10px 18px";

    const nutList = document.getElementById("nutritionList");
    nutList.innerHTML = "";
    data.nutrition.forEach(item => {
      nutList.innerHTML += `<li class="mb-2"><i class="bi bi-check-circle-fill me-2" style="color:${data.color}"></i>${item}</li>`;
    });
    document.getElementById("foodList").textContent = data.foods;

    const printCategory = document.getElementById("printCategory");
    const printCategoryAlt = document.getElementById("printCategoryAlt");
    const printName = document.getElementById("printName");
    const printBmi = document.getElementById("printBmi");
    const printStatus = document.getElementById("printStatus");
    const printNutritionList = document.getElementById("printNutritionList");
    const printFoods = document.getElementById("printFoods");
    const printGoalsList = document.getElementById("printGoalsList");
    const printFooter = document.querySelector(".print-footer");

    if (printCategory) {
      printCategory.textContent = `BMI Category: ${data.category}`;
    }
    if (printCategoryAlt) {
      printCategoryAlt.textContent = `BMI Category: ${data.category}`;
    }
    updateDateDisplays();
    if (printName) {
      printName.textContent = data.name;
    }
    if (printBmi) {
      printBmi.textContent = data.bmi;
    }
    if (printStatus) {
      printStatus.textContent = data.category;
      printStatus.style.backgroundColor = data.color;
      printStatus.style.color = "#000";
      printStatus.style.opacity = "0.18";
    }
    if (printFoods) {
      printFoods.textContent = data.foods;
    }
    if (printNutritionList) {
      printNutritionList.innerHTML = "";
      data.nutrition.forEach(item => {
        printNutritionList.innerHTML += `<li>${item}</li>`;
      });
    }
    if (printGoalsList) {
      const goals = [
        "Drink 2–3 liters of water",
        "Sleep 7–9 hours",
        "30 mins active movement",
      ];
      printGoalsList.innerHTML = "";
      goals.forEach(item => {
        printGoalsList.innerHTML += `<li>${item}</li>`;
      });
    }
    if (printFooter) {
      printFooter.classList.remove("d-none");
    }

    if (printButton) {
      printButton.classList.remove("d-none");
    }

    const track = document.querySelector(".bento-scale-track");
    const marker = document.getElementById("bmiMarker");
    track.style.opacity = "1";
    marker.style.opacity = "1";
    marker.style.boxShadow = `0 0 15px ${data.color}`;

    const minBMI = 15;
    const maxBMI = 40;
    let percentage = ((data.bmi - minBMI) / (maxBMI - minBMI)) * 100;
    percentage = Math.max(0, Math.min(100, percentage));

    marker.style.left = "0%";
    setTimeout(() => {
      marker.style.left = `calc(${percentage}% - 12px)`;
    }, 100);
  }
});
