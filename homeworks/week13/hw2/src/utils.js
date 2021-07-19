export function escapeHtml(unsafe) {
  return unsafe
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#039;')
}

export function appendComment(container, comment, isPrepend) {
  const commentBlock = `
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">#${escapeHtml(comment.site_post_id.toString())} ${escapeHtml(comment.nickname)}</h5>
        <p class="card-text">${escapeHtml(comment.created_time)}</p>
        <p class="card-text">${escapeHtml(comment.content)}</p>
      </div>
    </div>
  `
  if (isPrepend) {
    container.prepend(commentBlock)
  } else {
    container.append(commentBlock)
  }
}

export function appendStyle(cssTemplate) {
  const styleElement = document.createElement('style')
  styleElement.type = 'text/css'
  styleElement.appendChild(document.createTextNode(cssTemplate))
  document.head.appendChild(styleElement)
}
