<script>
  const content = document.querySelector('#content');

  content.innerHTML =
    `
    <div class="w-100 vh-100 d-flex">
      <div class="flex-grow-1 order-2 w-75 d-flex justify-content-center flex-column row-gap-3">
        <h1 style="font-size: clamp(5rem, 10vw, 10rem); font-weight: 700; text-transform: uppercase;">Error!</h1>
        <p style="font-size: clamp(0.8rem, 2vw, 2rem);">We couldn't locate what you're searching for. Apologies for the inconvenience."</p>
        <div>
          <a href="/" class="btn btn-primary">Go Home</a>
        </div>
      </div>
      <div class="flex-grow-1 order-1 w-100 " style="user-select: none">
        <img src="/public/assets/images/404.svg" alt="" class="w-100 h-100">
      </div>
    </div>
  `;
</script>