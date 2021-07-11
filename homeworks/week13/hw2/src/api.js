import $ from 'jquery'

export function getCommentsFromAPI(apiUrl, siteKey, limit, cb) {
  $.ajax({
    metnod: 'GET',
    url: `${apiUrl}/api_comments.php?site_key=${siteKey}&limit=${limit}`
  }).done((data) => {
    cb(data)
  })
}

export function addNewComment(apiUrl, newComment, cb) {
  $.ajax({
    type: 'POST',
    url: `${apiUrl}/api_add_comment.php`,
    data: newComment
  }).done((data) => {
    cb(data)
  })
}
