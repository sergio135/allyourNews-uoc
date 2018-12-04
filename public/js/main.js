/////////////////////////////////////////////////////
// Archivo global de JS para añadir interactividad //
/////////////////////////////////////////////////////
//////// Auxilar Functions ///////////
const Fetch = (url, headers) =>
  fetch(url, {
    ...headers
  }).then(res => {
    if (res.ok) {
      return res.json();
    } else {
      throw new Error(res.statusText);
    }
  });

///////// Global Config /////////////
const newAttack = {
  urls: {
    domain: window.location.origin,
    loginApi: `${window.location.origin}/new/api/login`,
    registerApi: `${window.location.origin}/new/api/login`,
    articlesApi: `${window.location.origin}/new/api/articles`,
    dashboard: `${window.location.origin}/new/dashboard`
  }
};

///////// FrontEnd logic /////////////
window.onload = () => {
  document.querySelector("#auth-form").onload = () => {
    document.querySelector("#auth-form").addEventListener("submit", event => {
      event.preventDefault();
      if (event.target.attributes.register) {
        Fetch(newAttack.urls.registerApi).then(res => {
          if (res.error) {
            const errBox = document.querySelector(".auth .error-modal");
            errBox.style.display = "block";
            errBox.innerHTML = res.error.messagge;
          } else {
            window.location.href = newAttack.urls.dashboard;
          }
        });
      } else {
        Fetch(newAttack.urls.loginApi).then(res => {
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
  };

  document.querySelector("main.dashboard").onload = () => {
    const renderArticles = tags => {
      Fetch(newAttack.urls.articlesApi).then(res => {
        if (res.error) {
        } else {
        }
      });
    };
  };
};
