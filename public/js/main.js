function removeMessageFromURL() {
  // Courtesy of Arun Chandran Chackachatti on Stackoverflow
  // https://stackoverflow.com/questions/16941104/remove-a-parameter-to-the-url-with-javascript
  let url = document.location.href;
  let urlparts = url.split("?");

  if (urlparts.length >= 2) {
    let urlBase = urlparts.shift();
    let queryString = urlparts.join("?");

    let prefix = encodeURIComponent("message") + "=";
    let pars = queryString.split(/[&;]/g);
    for (let i = pars.length; i-- > 0; )
      if (pars[i].lastIndexOf(prefix, 0) !== -1) pars.splice(i, 1);
    url = urlBase + "?" + pars.join("&");
    window.history.replaceState("", document.title, url); // added this line to push the new url directly to url bar .
    // Above line edited to use replaceState instead of pushState, to avoid adding the same url to the history.
  }
  return url;
}
