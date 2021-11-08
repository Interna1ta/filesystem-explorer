//Context Menu

const contextMenu = document.getElementById("context-menu");
var scope = document.querySelectorAll(".file__area");
var oldName;
var moveDir;

scope.forEach((item) => {
  item.addEventListener("contextmenu", (event) => {
    var url_string = window.location.href;
    var url = new URL(url_string);
    var dirFromUrl = url.searchParams.get("dir");
    event.preventDefault();

    const { clientX: mouseX, clientY: mouseY } = event;

    contextMenu.style.top = `${mouseY}px`;
    contextMenu.style.left = `${mouseX}px`;

    contextMenu.classList.add("visible");

    oldName =
      (dirFromUrl ? dirFromUrl + "/" : "") +
      event.target.closest(".file__area").querySelector(".selectedName")
        .innerHTML;
  });
});

document.addEventListener("click", (e) => {
  const eventTarget = e.target;

  contextMenu.classList.remove("visible");

  if (eventTarget.dataset.target === "#renameModal") {
    document.getElementById("changeNameForm").value = oldName;
  }

  if (eventTarget.dataset.move === "move") {
    moveDir = eventTarget.querySelector(".selectedName")
      ? eventTarget.querySelector(".selectedName").innerHTML
      : eventTarget.closest(".selectedName").innerHTML;

    document.getElementById("moveDirName").value = moveDir;
    document.getElementById("moveModalInput").value = oldName;
  }

  if (eventTarget.dataset.target === "#deleteModal") {
    document.getElementById("deleteDirForm").value = oldName;
  }
});
