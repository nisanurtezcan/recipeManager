// ============================================
// ACCOUNT PAGE JAVASCRIPT - WITH EDIT FEATURE
// ============================================

// Sayfa yüklenince tarifleri çek
document.addEventListener('DOMContentLoaded', function() {
    loadMyRecipes();
    loadOtherRecipes();
    initAddRecipeForm();
});

// ============================================
// ADD RECIPE FORM HANDLER
// ============================================
function initAddRecipeForm() {
    document.getElementById('addRecipeForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const formData = {
            recipe_name: document.getElementById('recipe_title').value,
            category: document.getElementById('recipe_category').value,
            description: document.getElementById('recipe_description').value,
            ingredients: document.getElementById('recipe_ingredients').value,
            instructions: document.getElementById('recipe_instructions').value
        };
        
        try {
            const response = await fetch('../api/recipes/add.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify(formData)
            });
            
            const data = await response.json();
            
            if (data.success) {
                showSuccess('Recipe added successfully!');
                
                // Formu sıfırla ve kapat
                this.reset();
                const collapseElement = document.getElementById('recipeForm');
                const bsCollapse = bootstrap.Collapse.getInstance(collapseElement);
                if (bsCollapse) {
                    bsCollapse.hide();
                }
                
                // Tarifleri yeniden yükle
                loadMyRecipes();
            } else {
                showError('Failed to add recipe: ' + data.message);
            }
        } catch (error) {
            showError('Error: ' + error.message);
        }
    });
}

// ============================================
// LOAD MY RECIPES
// ============================================
function loadMyRecipes() {
    const loading = document.getElementById('my-recipes-loading');
    const container = document.getElementById('my-recipes-container');
    const emptyMsg = document.getElementById('my-recipes-empty');
    
    loading.style.display = 'block';
    container.innerHTML = '';
    emptyMsg.style.display = 'none';
    
    fetch('../api/recipes/my-list.php')
        .then(res => res.json())
        .then(data => {
            loading.style.display = 'none';
            
            if (data.success && data.data.length > 0) {
                displayMyRecipes(data.data);
            } else {
                emptyMsg.style.display = 'block';
            }
        })
        .catch(error => {
            console.error('Error loading my recipes:', error);
            loading.style.display = 'none';
            showError('Failed to load your recipes');
        });
}

function displayMyRecipes(recipes) {
    const container = document.getElementById('my-recipes-container');
    container.innerHTML = '';
    
    recipes.forEach(recipe => {
        container.innerHTML += createMyRecipeCard(recipe);
    });
}

function createMyRecipeCard(recipe) {
    return `
        <div class="card recipe-card shadow-sm mb-3" id="recipe-card-${recipe.id}">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <h5 class="card-title mb-0">${escapeHtml(recipe.title)}</h5>
                    <div>
                        <button class="btn btn-sm btn-warning me-1" onclick="showEditForm(${recipe.id})">
                            <i class="fa-solid fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="deleteRecipe(${recipe.id})">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </div>
                
                <span class="badge bg-secondary mb-2">${recipe.category || 'Uncategorized'}</span>
                
                ${recipe.description ? `<p class="card-text text-muted small">${escapeHtml(recipe.description)}</p>` : ''}
                
                <div class="mt-3">
                    <p class="mb-1"><strong>Ingredients:</strong></p>
                    <p class="small">${escapeHtml(recipe.ingredients || 'N/A')}</p>
                </div>
                
                <div class="mt-2">
                    <p class="mb-1"><strong>Instructions:</strong></p>
                    <p class="small">${escapeHtml(recipe.instructions || 'N/A')}</p>
                </div>
                
                <small class="text-muted">
                    <i class="fa-solid fa-clock me-1"></i>
                    Added on ${formatDate(recipe.created_at)}
                </small>
                
                <!-- EDIT FORM (Hidden by default) -->
                <div id="edit-form-${recipe.id}" class="mt-3" style="display: none;">
                    <hr>
                    <h6 class="text-primary">Edit Recipe</h6>
                    <form onsubmit="updateRecipe(event, ${recipe.id})">
                        <div class="mb-2">
                            <label class="form-label small">Title</label>
                            <input type="text" class="form-control form-control-sm" 
                                   id="edit-title-${recipe.id}" value="${escapeHtml(recipe.title)}" required>
                        </div>
                        <div class="mb-2">
                            <label class="form-label small">Category</label>
                            <select class="form-select form-select-sm" id="edit-category-${recipe.id}">
                                <option value="desserts" ${recipe.category === 'desserts' ? 'selected' : ''}>Desserts</option>
                                <option value="drinks" ${recipe.category === 'drinks' ? 'selected' : ''}>Drinks</option>
                                <option value="soups" ${recipe.category === 'soups' ? 'selected' : ''}>Soups</option>
                                <option value="meat" ${recipe.category === 'meat' ? 'selected' : ''}>Meat & Chicken</option>
                                <option value="pastries" ${recipe.category === 'pastries' ? 'selected' : ''}>Pastries</option>
                                <option value="oven" ${recipe.category === 'oven' ? 'selected' : ''}>Oven Dishes</option>
                                <option value="rice" ${recipe.category === 'rice' ? 'selected' : ''}>Rice & Pasta</option>
                                <option value="vegetable" ${recipe.category === 'vegetable' ? 'selected' : ''}>Vegetable Dishes</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label class="form-label small">Description</label>
                            <textarea class="form-control form-control-sm" rows="2" 
                                      id="edit-description-${recipe.id}">${escapeHtml(recipe.description || '')}</textarea>
                        </div>
                        <div class="mb-2">
                            <label class="form-label small">Ingredients</label>
                            <textarea class="form-control form-control-sm" rows="2" 
                                      id="edit-ingredients-${recipe.id}" required>${escapeHtml(recipe.ingredients || '')}</textarea>
                        </div>
                        <div class="mb-2">
                            <label class="form-label small">Instructions</label>
                            <textarea class="form-control form-control-sm" rows="3" 
                                      id="edit-instructions-${recipe.id}" required>${escapeHtml(recipe.instructions || '')}</textarea>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-sm btn-success">
                                <i class="fa-solid fa-check me-1"></i> Save
                            </button>
                            <button type="button" class="btn btn-sm btn-secondary" onclick="hideEditForm(${recipe.id})">
                                <i class="fa-solid fa-times me-1"></i> Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    `;
}

// ============================================
// EDIT RECIPE FUNCTIONS
// ============================================
function showEditForm(recipeId) {
    // Hide all other edit forms
    document.querySelectorAll('[id^="edit-form-"]').forEach(form => {
        form.style.display = 'none';
    });
    
    // Show this edit form
    document.getElementById(`edit-form-${recipeId}`).style.display = 'block';
}

function hideEditForm(recipeId) {
    document.getElementById(`edit-form-${recipeId}`).style.display = 'none';
}

async function updateRecipe(event, recipeId) {
    event.preventDefault();
    
    const formData = {
        recipe_id: recipeId,
        recipe_name: document.getElementById(`edit-title-${recipeId}`).value,
        category: document.getElementById(`edit-category-${recipeId}`).value,
        description: document.getElementById(`edit-description-${recipeId}`).value,
        ingredients: document.getElementById(`edit-ingredients-${recipeId}`).value,
        instructions: document.getElementById(`edit-instructions-${recipeId}`).value
    };
    
    try {
        const response = await fetch('../api/recipes/update.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(formData)
        });
        
        const data = await response.json();
        
        if (data.success) {
            showSuccess('Recipe updated successfully!');
            hideEditForm(recipeId);
            loadMyRecipes(); // Reload to show updated content
        } else {
            showError('Failed to update: ' + data.message);
        }
    } catch (error) {
        showError('Error: ' + error.message);
    }
}

// ============================================
// LOAD OTHER RECIPES
// ============================================
function loadOtherRecipes() {
    const loading = document.getElementById('other-recipes-loading');
    const container = document.getElementById('other-recipes-container');
    const emptyMsg = document.getElementById('other-recipes-empty');
    
    loading.style.display = 'block';
    container.innerHTML = '';
    emptyMsg.style.display = 'none';
    
    fetch('../api/recipes/all-list.php')
        .then(res => res.json())
        .then(data => {
            loading.style.display = 'none';
            
            if (data.success && data.data.length > 0) {
                displayOtherRecipes(data.data);
            } else {
                emptyMsg.style.display = 'block';
            }
        })
        .catch(error => {
            console.error('Error loading other recipes:', error);
            loading.style.display = 'none';
            showError('Failed to load community recipes');
        });
}

function displayOtherRecipes(recipes) {
    const container = document.getElementById('other-recipes-container');
    container.innerHTML = '';
    
    recipes.forEach(recipe => {
        container.innerHTML += createOtherRecipeCard(recipe);
    });
}

function createOtherRecipeCard(recipe) {
    return `
        <div class="card recipe-card shadow-sm mb-3">
            <div class="card-body">
                <h5 class="card-title">${escapeHtml(recipe.title)}</h5>
                
                <div class="d-flex gap-2 mb-2">
                    <span class="badge bg-secondary">${recipe.category || 'Uncategorized'}</span>
                    <span class="recipe-author">
                        <i class="fa-solid fa-user me-1"></i>
                        ${escapeHtml(recipe.username)}
                    </span>
                </div>
                
                ${recipe.description ? `<p class="card-text text-muted small">${escapeHtml(recipe.description)}</p>` : ''}
                
                <div class="mt-3">
                    <p class="mb-1"><strong>Ingredients:</strong></p>
                    <p class="small">${escapeHtml(recipe.ingredients || 'N/A')}</p>
                </div>
                
                <div class="mt-2">
                    <p class="mb-1"><strong>Instructions:</strong></p>
                    <p class="small">${escapeHtml(recipe.instructions || 'N/A')}</p>
                </div>
            </div>
        </div>
    `;
}

// ============================================
// DELETE RECIPE
// ============================================
function deleteRecipe(id) {
    if (!confirm('Are you sure you want to delete this recipe?')) return;
    
    fetch('../api/recipes/delete.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({recipe_id: id})
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            showSuccess('Recipe deleted successfully!');
            loadMyRecipes(); // Reload recipes
        } else {
            showError('Failed to delete: ' + data.message);
        }
    })
    .catch(error => {
        showError('Error: ' + error.message);
    });
}

// ============================================
// HELPER FUNCTIONS
// ============================================

// XSS koruması
function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}
//ctrl shift r cache temizleme
// Tarih formatla
function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', { 
        year: 'numeric', 
        month: 'short', 
        day: 'numeric' 
    });
}

// Success mesajı
function showSuccess(message) {
    alert(message);
}

// Error mesajı
function showError(message) {
    alert(message);
}
