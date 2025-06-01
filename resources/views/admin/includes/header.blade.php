<div class="wrapper">

  <!-- Preloader -->
  <style>
  .preloader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: rgba(255, 255, 255, 0.8); /* Changed to 80% transparent white */
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }
  
  .preloader-logo {
    width: 140px;
    height: 140px;
    border-radius: 50%;
    background: linear-gradient(135deg, #0d6efd, #0dcaf0);
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 20px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    animation: pulse 1.5s infinite;
  }
  
  .preloader-logo i {
    font-size: 60px;
    color: white;
  }
  
  .dumbbell-wrapper {
    position: relative;
    width: 120px;
    height: 30px;
  }
  
  .dumbbell {
    position: absolute;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: #343a40;
    animation: moveWeight 2s infinite ease-in-out;
  }
  
  .dumbbell:before, .dumbbell:after {
    content: '';
    position: absolute;
    width: 40px;
    height: 8px;
    background: #343a40;
    top: 50%;
    transform: translateY(-50%);
  }
  
  .dumbbell:before {
    left: -35px;
  }
  
  .dumbbell:after {
    right: -35px;
  }
  
  .dumbbell:first-child {
    left: 0;
    animation-delay: 0s;
  }
  
  .dumbbell:last-child {
    right: 0;
    animation-delay: 1s;
  }
  
  .progress-bar {
    width: 200px;
    height: 3px;
    background: #e9ecef;
    border-radius: 3px;
    margin-top: 25px;
    position: relative;
    overflow: hidden;
  }
  
  .progress {
    position: absolute;
    height: 100%;
    width: 0;
    background: linear-gradient(to right, #0d6efd, #0dcaf0);
    animation: loading 2.5s infinite;
  }
  
  .preloader-text {
    margin-top: 15px;
    font-size: 16px;
    color: #6c757d;
    font-weight: 600;
    letter-spacing: 1px;
  }
  
  @keyframes pulse {
    0% {
      transform: scale(1);
    }
    50% {
      transform: scale(1.05);
    }
    100% {
      transform: scale(1);
    }
  }
  
  @keyframes moveWeight {
    0%, 100% {
      transform: translateX(0) rotate(0deg);
    }
    50% {
      transform: translateX(60px) rotate(360deg);
    }
  }
  
  @keyframes loading {
    0% {
      width: 0;
    }
    50% {
      width: 100%;
    }
    100% {
      width: 100%;
    }
  }
  </style>

  <div class="preloader">
    <div class="preloader-logo">
      <i class="fas fa-dumbbell"></i>
    </div>
    <div class="dumbbell-wrapper">
      <div class="dumbbell"></div>
      <div class="dumbbell"></div>
    </div>
    <div class="progress-bar">
      <div class="progress"></div>
    </div>
    <div class="preloader-text">FITNESS GYM LOADING</div>
  </div>

  <!-- Add script to hide preloader when page is loaded -->
  <script>
    window.addEventListener('load', function() {
      const preloader = document.querySelector('.preloader');
      preloader.style.transition = 'opacity 0.3s ease';
      preloader.style.opacity = '0';
      
      setTimeout(function() {
        preloader.style.display = 'none';
      }, 500);
    });
  </script>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-lg navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button">
          <i class="fas fa-bars"></i>
        </a>
      </li>
    </ul>
    
    <!-- Centered Text -->
    <div class="navbar-nav mx-auto">
      <span class="navbar-text text-muted text-dark fw-bold">
        Fitness Gym Center
      </span>
    </div>
  </nav>
  <!-- /.navbar -->
  
</div>
