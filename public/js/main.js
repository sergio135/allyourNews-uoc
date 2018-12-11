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
  return Fetch(newAttack.api.articles + tagString)
    .then(res => {
      if (res.error) {
        throw new Error(res.error);
      } else {
        return feednami.load(res.articles[0]);
      }
    })
    .then(feed => {
      console.log(feed);
      return feed.entries.map(
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
  if (authForm)
    authForm.addEventListener("submit", event => {
      event.preventDefault();
      if (event.target.attributes.register) {
        Fetch(newAttack.api.register).then(res => {
          if (res.error) {
            const errBox = document.querySelector(".auth .error-modal");
            errBox.style.display = "block";
            errBox.innerHTML = res.error.messagge;
          } else {
            window.location.href = newAttack.urls.dashboard;
          }
        });
      } else {
        Fetch(newAttack.api.login).then(res => {
          if (res.error) {
            const errBox = document.querySelector(".auth .error-modal");
            errBox.style.display = "block";
            errBox.innerHTML = res.error.messagge;
          } else {
            window.location.href = newAttack.urls.dashboard;
          }
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
  if (tags) {
    tags.forEach(tag => {
      tag.addEventListener("click", event => {
        renderArticles(event.target.innerHTML.toLowerCase()).then(res => {
          content.innerHTML = res.join();
        });
      });
    });
  }
};
