window.addEventListener("click", (e) => {
  if (e.target.dataset.target === "#exampleModal") {
    document.getElementById("changeNameForm").value = e.target.id;
  }
});
