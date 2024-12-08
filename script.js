document.addEventListener("DOMContentLoaded", () => {
    // First Slider - Top Games
    const topGamesSlider = document.getElementById("top-games-slider");
    const topGamesPrevBtn = document.querySelector(".top-games-slider .prev-btn");
    const topGamesNextBtn = document.querySelector(".top-games-slider .next-btn");

    let topGamesIndex = 0;
    const totalTopGames = topGamesSlider.children.length;

    topGamesPrevBtn.addEventListener("click", () => {
        if (topGamesIndex > 0) {
            topGamesIndex--;
        } else {
            topGamesIndex = totalTopGames - 1;
        }
        topGamesSlider.style.transform = `translateX(-${topGamesIndex * 320}px)`;
    });

    topGamesNextBtn.addEventListener("click", () => {
        if (topGamesIndex < totalTopGames - 1) {
            topGamesIndex++;
        } else {
            topGamesIndex = 0;
        }
        topGamesSlider.style.transform = `translateX(-${topGamesIndex * 320}px)`;
    });

    // Second Slider - Latest Releases
    const latestReleasesSlider = document.getElementById("latest-releases-slider");
    const latestReleasesPrevBtn = document.querySelector(".latest-releases-slider .prev-btn");
    const latestReleasesNextBtn = document.querySelector(".latest-releases-slider .next-btn");

    let latestReleasesIndex = 0;
    const totalLatestReleases = latestReleasesSlider.children.length;

    latestReleasesPrevBtn.addEventListener("click", () => {
        if (latestReleasesIndex > 0) {
            latestReleasesIndex--;
        } else {
            latestReleasesIndex = totalLatestReleases - 1;
        }
        latestReleasesSlider.style.transform = `translateX(-${latestReleasesIndex * 320}px)`;
    });

    latestReleasesNextBtn.addEventListener("click", () => {
        if (latestReleasesIndex < totalLatestReleases - 1) {
            latestReleasesIndex++;
        } else {
            latestReleasesIndex = 0;
        }
        latestReleasesSlider.style.transform = `translateX(-${latestReleasesIndex * 320}px)`;
    });
});

