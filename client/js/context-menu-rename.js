//Context Menu

const contextMenu = document.getElementById("context-menu");
var scope = document.querySelectorAll(".file__area");
var oldName;

scope.forEach((item) => {

  item.addEventListener("contextmenu", (event) => {
    event.preventDefault();

    item.classList.add("item-active");

    const { clientX: mouseX, clientY: mouseY } = event;

    contextMenu.style.top = `${mouseY}px`;
    contextMenu.style.left = `${mouseX}px`;

    contextMenu.classList.add("visible");

    if (location.href.split("=")[1] === undefined) {
      oldName = event.target
        .closest(".file__area")
        .querySelector(".selectedName").innerHTML;
    } else {
      oldName =
        location.href.split("=")[1] +
        "/" +
        event.target.closest(".file__area").querySelector(".selectedName")
          .innerHTML;
    }
  });
});

document.addEventListener("click", (e) => {
  contextMenu.classList.remove("visible");

  if (e.target.dataset.target === "#renameModal") {
    document.getElementById("changeNameForm").value = oldName;
  }
  if (e.target.dataset.target === "#deleteModal") {
    document.getElementById("deleteDirForm").value = oldName;
  }
});
