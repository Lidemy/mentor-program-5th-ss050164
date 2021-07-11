import $ from 'jquery'
import { getCommentsFromAPI, addNewComment } from './api'
import { appendComment, appendStyle } from './utils'
import { cssTemplate, getLoadMoreBtn, getForm } from './template'

/* eslint-disable */
export function init(options) {
  /* eslint-enable */
  const { siteKey, apiUrl } = options
  let containerElement = null

  let limit = 5
  let total = null
  let count = 0

  const loadMoreClassName = `${siteKey}-load-more`
  const loadMoreSelector = `.${loadMoreClassName}`

  const commentsClassName = `${siteKey}-comments`
  const commentsSelector = `.${commentsClassName}`

  const formClassName = `${siteKey}-add-comment-form`
  const formSelector = `.${formClassName}`

  containerElement = $(options.containerSelector)
  containerElement.append(getForm(formClassName, commentsClassName))
  appendStyle(cssTemplate)

  showComments()
  $(commentsSelector).on('click', loadMoreSelector, () => {
    limit += 5
    showComments()
  })

  $(formSelector).submit((e) => {
    e.preventDefault()
    const nicknameDOM = $(`${formSelector} input[name=nickname]`)
    const contentDOM = $(`${formSelector} textarea[name=content]`)
    const newComment = {
      site_key: siteKey,
      nickname: nicknameDOM.val(),
      content: contentDOM.val()
    }

    addNewComment(apiUrl, newComment, (data) => {
      if (!data.is_success) {
        alert(data.message)
        return
      }
      nicknameDOM.val('')
      contentDOM.val('')

      // if total is equal to count, it means all comments are displayed before adding the new comment
      // hence, we need to set count to zero manually, otherwise showComments() will calculate the wrong count
      if (total === count) {
        count = 0
      }
      showComments()
    })

    if (total === limit) {
      limit += 5
    }
  })

  function showComments() {
    // call API to get comments
    getCommentsFromAPI(apiUrl, siteKey, limit, (data) => {
      if (!data.is_success) {
        alert(data.message)
        return
      }
      const { comments } = data
      $(commentsSelector).empty()

      // get the quantity of the comments.
      // Null means first time to call showComments.
      // if comment[0].site_post_id is greater than total, it means a new comment is added.
      if (total === null || comments[0].site_post_id > total) {
        total = comments[0].site_post_id
      }

      for (const comment of comments) {
        appendComment($(commentsSelector), comment, false)
        count++
      }

      // if total is greater than count, it means there are still more comments to show
      // hence, show the load more button and set count to 0 to avoid duplicate count in next round
      if (total > count) {
        const loadMoreBtn = getLoadMoreBtn(loadMoreClassName)
        $(commentsSelector).append(loadMoreBtn)
        count = 0
      }
    })
  }
}
