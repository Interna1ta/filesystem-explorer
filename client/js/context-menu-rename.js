//Context Menu

const contextMenu = document.getElementById("context-menu");
var scope = document.querySelectorAll(".file__area");
var oldName;
var moveDir;
var fileName;

scope.forEach((item) => {
  item.addEventListener("contextmenu", (event) => {
    event.preventDefault();

    item.classList.add("item-active");

    fileName = event.target
      .closest(".file__area")
      .querySelector(".selectedName").innerHTML;

    const { clientX: mouseX, clientY: mouseY } = event;

    contextMenu.style.top = `${mouseY}px`;
    contextMenu.style.left = `${mouseX}px`;

    contextMenu.classList.add("visible");

    if (location.href.split("=")[1] === undefined) {
      oldName = fileName;
    } else {
      oldName = location.href.split("=")[1] + "/" + fileName;
    }
  });
});

document.addEventListener("click", (e) => {
  if (e.target.dataset.target === "#renameModal") {
    document.getElementById("changeNameForm").value = oldName;
  }
  if (e.target.dataset.move === "move") {
    moveDir = e.target.querySelector(".selectedName")
      ? e.target.querySelector(".selectedName").innerHTML
      : e.target.closest(".selectedName").innerHTML;

    document.getElementById("moveDirName").value = moveDir;
    document.getElementById("moveModalInput").value = oldName;
  }
  if (e.target.dataset.target === "#deleteModal") {
    document.getElementById("deleteDirForm").value = oldName;
  }
  contextMenu.classList.remove("visible");
});
