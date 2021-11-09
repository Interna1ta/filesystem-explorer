//Context Menu

const contextMenu = document.getElementById("context-menu");
var scope = document.querySelectorAll(".file__area");
var oldDirectory;
var moveDir;
var route;

scope.forEach((item) => {
  item.addEventListener("contextmenu", (event) => {
    var url_string = window.location.href;
    var url = new URL(url_string);
    route = url.searchParams.get("dir") ? url.searchParams.get("dir") : "";
    event.preventDefault();

    item.classList.add("item-active");

    fileName = event.target
      .closest(".file__area")
      .querySelector(".selectedName").innerHTML;

    const { clientX: mouseX, clientY: mouseY } = event;

    contextMenu.style.top = `${mouseY}px`;
    contextMenu.style.left = `${mouseX}px`;

    contextMenu.classList.add("visible");

    oldDirectory = (route ? route + "/" : "") + fileName;
  });
});

document.addEventListener("click", (e) => {
  const eventTarget = e.target;

  contextMenu.classList.remove("visible");

  if (eventTarget.dataset.target === "#renameModal") {
    document.getElementById("oldDirName").value = oldDirectory;
    document.getElementById("routeDirectory").value = route;
  }

  if (eventTarget.dataset.move === "move") {
    moveDir = eventTarget.querySelector(".selectedName")
      ? eventTarget.querySelector(".selectedName").innerHTML
      : eventTarget.closest(".selectedName").innerHTML;

    document.getElementById("moveDirName").value = fileName;
    document.getElementById("moveFileName").value = oldDirectory;
    document.getElementById("moveModalInput").value +=
      document.getElementById("moveModalInput").value !== ""
        ? "/" + moveDir
        : moveDir;
  }

  if (eventTarget.dataset.target === "#deleteModal") {
    document.getElementById("deleteDirName").value = oldDirectory;
  }
});
