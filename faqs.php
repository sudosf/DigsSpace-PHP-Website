<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <title>DigsSpace FAQ</title>

    <style>
        /* Reset some default styles */
          * {
              margin: 0;
              padding: 0;
              box-sizing: border-box;
          }
  
          /* FAQ sections */
          .faq-section {
              margin: 20px;
              padding: 20px;
              background-color: #fff;
              border: 1px solid #ddd;
              border-radius: 5px;
              box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
          }
  
          .faq-section h2 {
              color: #4169E1;
              font-size: 24px;
              margin-bottom: 20px;
          }
  
          /* FAQ items */
          .faq-item {
              margin-bottom: 20px;
          }
  
          .faq-item h3 {
              color: #333;
              font-size: 18px;
              margin-bottom: 10px;
          }
  

          /* Links */
          a {
              color: #4169E1;
              text-decoration: none;
          }
  
          a:hover {
              text-decoration: underline;
          }
          
  
      </style>
  
     
</head>
<body>
 <?php 
    $currentPage = 'faqs';
    include('components/header.php'); 
  ?>

    <header class="text-center bg-primary p-5 text-white">
        <h1>Frequently Asked Questions</h1>
    </header>

    <section class="faq-section">
        <h2>General Questions</h2>
        <div class="faq-item">
            <h3>1. What is DigsSpace?</h3>
            <p style="color: black;">DigsSpace is a system designed to assist students in finding suitable accommodation (digs) off-campus.</p>
        </div>
        <div class="faq-item">
            <h3>2. Who are the stakeholders of DigsSpace?</h3>
            <p style="color: black;">The stakeholders include tenants, agents, and prospective tenants.</p>
        </div>
       
    </section>

    <section class="faq-section">
        <h2>Registration and Usage</h2>
        <div class="faq-item">
            <h3>1. How can I register as a tenant?</h3>
            <p style="color: black;">To register as a tenant, visit our registration page and fill out the required information.</p>
        </div>
        <div class="faq-item">
            <h3>2. Can I browse properties without registration?</h3>
            <p style="color: black;">Yes, prospective tenants can browse the website without registration.</p>
        </div>
       
    </section>

    <section class="faq-section">
        <h2>Property Listings</h2>
        <div class="faq-item">
            <h3>1. How can agents register a property?</h3>
            <p style="color: black;">Agents can register a property by logging into their account and providing property details.</p>
        </div>
        <div class="faq-item">
            <h3>2. What information should I provide when listing a digs?</h3>
            <p style="color: black;">You should provide details such as location, rent, amenities, and property photos.</p>
        </div>
        
    </section>

    <section class="faq-section">
        <h2>Costs</h2>
        <div class="faq-item">
            <h3>1. Do l pay to use DigsSpace?</h3>
            <p style="color: black;">NO! DigsSpace is a free to use resource .</p>
        </div>
        <div class="faq-item">
            <h3>2. Do l pay to contact agents?</h3>
            <p style="color: black;">Absolutely not, agent details are freely available for you to enquire .</p>
        </div>
        
    </section>

    <?php include("components/footer.inc.php"); ?>

</body>
</html>
