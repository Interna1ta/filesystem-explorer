//Context Menu

const contextMenu = document.getElementById("context-menu");
var scope = document.querySelectorAll(".file__area");
var oldName;

scope.forEach((item) => {
  item.addEventListener("contextmenu", (event) => {
    event.preventDefault();

    const { clientX: mouseX, clientY: mouseY } = event;

    contextMenu.style.top = `${mouseY}px`;
    contextMenu.style.left = `${mouseX}px`;

    contextMenu.classList.add("visible");

    if (location.href.split("=")[1] === undefined) {
      oldName = event.target.querySelector(".selectedName").innerHTML;
    } else {
      oldName = location.href.split("=")[1] + "/" + event.target.querySelector(".selectedName").innerHTML;
    }
  });
});

document.addEventListener("click", (e) => {
  if (e.target.offsetParent != contextMenu) {
    contextMenu.classList.remove("visible");
  }
});

window.addEventListener("click", (e) => {
  if (e.target.dataset.target === "#renameModal") {
    document.getElementById("changeNameForm").value = oldName;
  }
  if (e.target.dataset.target === "#deleteModal") {
    document.getElementById("deleteDirForm").value = oldName;
  }
});
