import generateStructure from "../core/generateStructure.js";



function getAjaxFilterArticlesUrl() {

    return '/Desktop/ESGI/php/projet-jp/' + Routing.generate('ajax_filter_articles');
}

function filterArticlesByCategory(categoryId) {

    const ajaxUrl = getAjaxFilterArticlesUrl();

    
    const data = { category_id: categoryId };

    axios.get(ajaxUrl, { params: data })
        .then(response => {

            const articlesContainer = document.getElementById('articles-container'); 
            articlesContainer.innerHTML = response.data; 
        })
        .catch(error => {
            // En cas d'erreur
            console.error('Erreur AJAX :', error);
        });
}


const categorySelector = document.getElementById('category-selector'); // Remplacez par l'ID de votre sélecteur de catégorie
categorySelector.addEventListener('change', () => {
    const selectedCategoryId = categorySelector.value;
    filterArticlesByCategory(selectedCategoryId);
});