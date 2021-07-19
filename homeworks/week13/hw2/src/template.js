export const cssTemplate = `
  @media (min-width: 768px) {
    .wrapper {
      max-width: 70%;
      margin: 0 auto;
    }
  }

  .btn {
    margin: 10px 0px;
  }

  .card {
    margin-bottom: 10px;
  }
`
export function getLoadMoreBtn(className) {
  return `<button class="btn btn-primary ${className}">Load More</button>`
}

export function getForm(className, commentsClassName) {
  return `
    <div>
      <form class="${className}">
        <div class="form-group">
          <label>Nickname</label>
          <input name="nickname" type="text" class="form-control">
        </div>
        <div class="form-group">
          <label>Content</label>
          <textarea name="content" class="form-control" rows="4"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">submit</button>
      </form>
      <div class="${commentsClassName}">
      </div>
    </div>`
}
