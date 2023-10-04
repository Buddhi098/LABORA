function timer(n) {
    document.getElementById("resend").disabled = true;
    const interval = setInterval(() => {
      if (n == 0) {
        clearInterval(interval);
        document.getElementById("resend").disabled = false;
      }
      document.querySelector(".time").innerHTML = n;
      n = n - 1;
    }, 1000);
  }
  timer(15);
  document.getElementById("resend").onclick = function () {
    timer(15);
  };