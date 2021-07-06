document.querySelector('.articles').addEventListener('click', (e) => {
  if (e.target.classList.contains('article__read-btn')) {
    e.target.parentNode.parentNode.classList.toggle('hide')
    e.target.parentNode.parentNode.classList.toggle('show')
    const btn = e.target.closest('.article__read-btn')
    if (!e.target.parentNode.parentNode.classList.contains('hide')) {
      btn.innerText = 'SHOW LESS'
    } else {
      btn.innerText = 'READ MORE'
    }
  }
})
