//Context Menu

const contextMenu = document.getElementById("context-menu");
const scope = document.querySelectorAll(".file__area");

var oldName;

scope.forEach((item) => {
  item.addEventListener("contextmenu", (event) => {
    event.preventDefault();

    const { clientX: mouseX, clientY: mouseY } = event;

    contextMenu.style.top = `${mouseY}px`;
    contextMenu.style.left = `${mouseX}px`;

    contextMenu.classList.add("visible");
    oldName = event.target.innerHTML;
  });
});

document.addEventListener("click", (e) => {
  if (e.target.offsetParent != contextMenu) {
    contextMenu.classList.remove("visible");
  }
});

window.addEventListener("click", (e) => {
  if (e.target.dataset.target === "#exampleModal") {
    document.getElementById("changeNameForm").value = oldName;
  }
});
