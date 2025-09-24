
function togglePass(id) {
  console.log(id)
  const input = document.getElementById(id);
  if (input.type == "password"){

    input.type = "text";
  } else {

    input.type = "password";
  }
}