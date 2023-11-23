function generateIcons() {
  document.querySelectorAll('#projects article').forEach(article => {
    const iconGrid = document.createElement('div');
    iconGrid.classList.add('icon-grid');
    article.appendChild(iconGrid);
    
    [['star-plus-outline', 'Favorite icon, a star with a plus sign'],
     ['eye-plus-outline', 'Watch icon, an eye with a plus sign'],
     ['source-fork', 'Fork icon, a small abstract forking tree']]
    .forEach(([name, description]) => {
      const img = document.createElement('img');
      img.src = `images/${name}.svg`;
      img.alt = description;
      iconGrid.appendChild(img);
    })
  })
}

generateIcons();
