<?php include 'includes/header.php'; ?>

<style>
  #main-content {
    max-width: 800px;
    margin: 2rem auto;
    padding: 2rem;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #333;
  }

  #main-content h1 {
    color: #2c3e50;
    font-size: 2.2rem;
    margin-bottom: 1.5rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #f39c12;
  }

  #main-content p {
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: 1.2rem;
    color: #555;
  }

  #main-content strong {
    color: #2c3e50;
    font-weight: 600;
  }

  #main-content a {
    color: #3498db;
    text-decoration: none;
    transition: color 0.3s;
  }

  #main-content a:hover {
    color: #2980b9;
    text-decoration: underline;
  }

  .contact-info {
    background-color: #f8f9fa;
    padding: 1.5rem;
    border-radius: 8px;
    margin: 1.5rem 0;
    border-left: 4px solid #f39c12;
  }

  .contact-info p {
    margin: 0.8rem 0;
    display: flex;
    align-items: center;
  }

  .contact-info p::before {
    content: "•";
    color: #f39c12;
    font-weight: bold;
    display: inline-block;
    width: 1em;
    margin-left: -1em;
  }

  @media (max-width: 768px) {
    #main-content {
      margin: 1rem;
      padding: 1.5rem;
    }

    #main-content h1 {
      font-size: 1.8rem;
    }

    #main-content p {
      font-size: 1rem;
    }

    .contact-info {
      padding: 1rem;
    }
  }

  @media (max-width: 480px) {
    #main-content {
      padding: 1rem;
    }

    #main-content h1 {
      font-size: 1.5rem;
    }

    .contact-info p {
      flex-direction: column;
      align-items: flex-start;
    }

    .contact-info p::before {
      margin-left: 0;
      margin-right: 0.5rem;
    }
  }
</style>

<main id="main-content">
    <h1>Return Order</h1>
    <p>If you want to return your order, please contact us using the details below:</p>
    
    <div class="contact-info">
        <p><strong>Contact Number:</strong> +91 7376676696</p>
        <p><strong>Email:</strong> <a href="mailto:cloud7perfumes@gmail.com">cloud7perfumes@gmail.com</a></p>
    </div>
    
    <p>We'll be happy to assist you with your return request. Please have your order number ready when contacting us.</p>
</main>

<?php include 'includes/footer.php'; ?>
