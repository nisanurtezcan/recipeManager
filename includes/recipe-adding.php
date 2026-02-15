    <link rel="stylesheet" href="../public/assets/css/styles.css">

<style>
    
</style>

<!-- Add Recipe Button & Form -->
<div class="sticky-top-custom">
    <button class="add-recipe-btn mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#recipeForm">
        <i class="fa-solid fa-plus-circle me-2"></i>
        Add New Recipe
    </button>

    <!-- Collapse Form -->
    <div class="collapse mb-4" id="recipeForm">
        <div class="card shadow-lg" style="border-radius: 12px;">
            <div class="card-body">
                <h4 class="text-center mb-4" style="color: #4a2040;">
                    <i class="fa-solid fa-utensils me-2"></i>
                    Create Your Recipe
                </h4>
                
                <form id="addRecipeForm">
                    <div class="mb-3">
                        <label class="form-label">Recipe Title *</label>
                        <input type="text" class="form-control" id="recipe_title" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Category *</label>
                        <select class="form-select" id="recipe_category" required>
                            <option value="">Select category...</option>
                            <option value="desserts">Desserts</option>
                            <option value="drinks">Drinks</option>
                            <option value="soups">Soups</option>
                            <option value="meat">Meat & Chicken</option>
                            <option value="pastries">Pastries</option>
                            <option value="oven">Oven Dishes</option>
                            <option value="rice">Rice & Pasta</option>
                            <option value="vegetable">Vegetable Dishes</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" id="recipe_description" rows="2" placeholder="Brief description..."></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ingredients *</label>
                        <textarea class="form-control" id="recipe_ingredients" rows="3" placeholder="E.g., 2 eggs, 1 cup flour..." required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Instructions *</label>
                        <textarea class="form-control" id="recipe_instructions" rows="4" placeholder="Step by step instructions..." required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fa-solid fa-check me-2"></i>
                        Save Recipe
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>