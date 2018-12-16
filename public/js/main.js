/////////////////////////////////////////////////////
// Archivo global de JS para añadir interactividad //
/////////////////////////////////////////////////////
//////// Auxilar Functions ///////////
const Fetch = (url, headers) =>
  fetch(url, {
    headers: {
      "Content-Type": "application/json"
    },
    ...headers
  }).then(res => {
    if (res.ok) {
      return res.json();
    } else {
      throw new Error(res.statusText);
    }
  });

const CalculateTime = date => {
  const fixedDate = new Date(date);
  const now = new Date();
  const dif = now.getTime() - fixedDate.getTime();
  console.log(dif / (3600 * 1000));

  return `${parseInt(dif / (3600 * 1000))} h`;
};

const renderArticles = tag => {
  const tagString = tag ? `/${tag}` : "";
  console.log(newAttack.api.articles + tagString);
  return axios
    .get(newAttack.api.articles + tagString)
    .then(function(res) {
      if (!res.data.rssUrls || !res.data.rssUrls.length) {
        throw new Error("No has añadido ninguna RSS");
      }
      return res.data.rssUrls.map(rss => feednami.load(rss.url_rss));
    })
    .then(function(res) {
      return Promise.all(res);
    })
    .then(function(feed) {
      let arr = [];
      feed.forEach(i => {
        arr.push(...i.entries);
      });
      return arr.map(
        article => `
      <div class="card">
          <div class="card__img">
              <img src="${
                article.image && typeof article.image !== "object"
                  ? article.image
                  : "/public/images/world.png"
              }">
          </div>
          <div class="card__content">
              <div class="row between">
                  <div class="header-icon">
                      <img src="./public/images/accenture.jpg" />
                  </div>
                  <div class="header-title">
                      <h3>${article.title ? article.title : ""}</h3>
                      <h6>${article.subTitle ? article.subTitle : ""}</h6>
                  </div>
                  <div class="header-time">
                      <span>${
                        article.date ? CalculateTime(article.date) : ""
                      }</span>
                  </div>
              </div>
              <div class="description">
                  <p>${article.description ? article.description : ""}</p>
              </div>
              <div class="row between">
                  <span class="button red outline" onClick="">Eliminar</span>
                  <span class="button yellow outline" onClick="">Ver más!</span>
              </div>
          </div>
      </div>
    `
      );
    });
  // .catch(err => {
  //   debugger;
  //   console.error(err);
  //   errBox.style.display = "block";
  //   errBox.innerHTML =
  //     err.message || err.response.data.message || err.response.data.error.msg;
  // });
};

///////// Global Config /////////////
const newAttack = {
  urls: {
    domain: window.location.origin,
    dashboard: `${window.location.origin}/dashboard`
  },
  api: {
    register: `${window.location.origin}/api/register`,
    articles: `${window.location.origin}/api/articles`,
    login: `${window.location.origin}/api/login`
  }
};

///////// FrontEnd logic /////////////
window.onload = () => {
  const authForm = document.querySelector("#auth-form");
  const errBox = document.querySelector(".error-modal");
  if (authForm && errBox)
    authForm.addEventListener("submit", event => {
      event.preventDefault();
      if (event.target.attributes.register) {
        const { username, email, password } = event.target.children;
        axios
          .post(newAttack.api.register, {
            username: username.value,
            email: email.value,
            password: password.value
          })
          .then(function(res) {
            window.location.href = newAttack.urls.dashboard;
          })
          .catch(function(err) {
            console.error(err.response.data);
            errBox.style.display = "block";
            errBox.innerHTML =
              err.response.data.message || err.response.data.error.msg;
          });
      } else {
        const { username, password } = event.target.children;
        axios
          .post(newAttack.api.login, {
            username: username.value,
            password: password.value
          })
          .then(function(res) {
            window.location.href = newAttack.urls.dashboard;
          })
          .catch(function(err) {
            console.error(err.response.data);
            errBox.style.display = "block";
            errBox.innerHTML =
              err.response.data.message || err.response.data.error.msg;
          });
      }
    });

  const content = document.querySelector("#articles-area");
  if (content) {
    renderArticles().then(res => {
      content.innerHTML = res.join();
    });
  }

  const tags = document.querySelectorAll("#articles-tag");
  if (tags && errBox) {
    tags.forEach(tag => {
      tag.addEventListener("click", event => {
        renderArticles(event.target.innerHTML.toLowerCase())
          .then(res => {
            debugger;
            content.innerHTML = res.join();
          })
          .catch(err => {
            console.error(err);
          });
      });
    });
  }
};
