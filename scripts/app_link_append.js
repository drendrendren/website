const linkIconMap = {
    play: {
        img: "./assets/images/logo/etc/playstore_download_logo.png",
        alt: "playstore download logo",
        link: "https://play.google.com/store/apps/details?id="
    },
    appstore: {
        img: "./assets/images/logo/etc/appstore_download_logo.svg",
        alt: "appstore download logo",
        link: "https://apps.apple.com/kr/app/"
    },
    youtube: {
        img: "./assets/images/logo/etc/yt_logo.png",
        alt: "yt logo",
        link: "https://www.youtube.com/@"
    },
    instagram: {
        img: "./assets/images/logo/etc/instagram_logo.png",
        alt: "instagram logo",
        link: "https://www.instagram.com/"
    }
};

const container = document.getElementById('appInfoWrapper');

fetch("./assets/datas/app_link_data.json")
    .then(res => res.json())
    .then(data => {
        data.forEach(app => {
            const linksHtml = Object.entries(app.links)
                .map(([key, url]) => {
                    const icon = linkIconMap[key];
                    if (!icon) return "";

                    return `
            <a href="${icon.link}${url}" target="_blank" rel="noopener noreferrer" class="app-info-link">
              <img src="${icon.img}" alt="${icon.alt}" class="app-info-link-img">
            </a>
          `;
                })
                .join("");

            const html = `
        <div class="app-info-block">
          <div>
            <img src="./assets/images/logo/app/${app.logo}.png" alt="${app.name}" class="app-info-img">
          </div>

          <div class="app-info-detail-wrapper">
            <div>
              <h3>${app.name}</h3>
              <h4>${app.subtitle}</h4>
            </div>

            <div>
              ${linksHtml}
            </div>
          </div>
        </div>
      `;

            container.insertAdjacentHTML("beforeend", html);
        });
    })
    .catch(err => console.error("JSON 불러오기 실패:"));