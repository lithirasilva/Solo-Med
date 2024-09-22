
describe('Login Functionality', () => {
  beforeEach(() => {
    // Visit the login page before each test
    cy.visit('/login');
  });

  it('should display the login form', () => {
    // Check if the form elements are visible
    cy.get('input[id="email"]').should('be.visible');
    cy.get('input[id="password"]').should('be.visible');
    cy.get('button[type="submit"]').contains('Log in').should('be.visible');
  });

  it('should display validation errors for empty fields', () => {
    // Attempt to submit the form without entering any data
    cy.get('button[type="submit"]').click();
  
    // Check for validation errors on empty fields
    cy.get('#email').then(($input) => {
      if ($input.siblings('.mt-2').length) {
        cy.get('#email ~ .mt-2').should('exist').and('contain', 'The email field is required');
            } else {
        cy.get('input[id="email"]:invalid').should('exist');
      }
    });
    
    cy.get('#password').then(($input) => {
      if ($input.siblings('.mt-2').length) {
        cy.get('#password ~ .mt-2').should('exist').and('contain', 'The password field is required');
      } else {
        cy.get('input[id="password"]:invalid').should('exist');
      }
    });
  });

  it('should show an error message for invalid credentials', () => {
    // Enter invalid email and password
    cy.get('input[id="email"]').type('invalid@example.com');
    cy.get('input[id="password"]').type('invalidpassword');
    
    // Submit the form
    cy.get('button[type="submit"]').contains('Log in').click();

    // Check if the error message is displayed
    cy.get('.text-red-600').should('contain', 'These credentials do not match our records.');
  });

  it('should log in successfully with valid credentials', () => {
    // Enter valid email and password
    cy.get('input[id="email"]').type('correct@example.com');
    cy.get('input[id="password"]').type('correctpassword');
    
    // Submit the form
    cy.get('button[type="submit"]').contains('Log in').click();
  
    // Wait for the URL change and check if redirected to the correct page
    cy.url().should('include', '/dashboard'); // Adjust based on your app's routing
  });

  it('should allow the user to reset the password', () => {
    // Check if the 'Forgot your password?' link is visible and clickable
    cy.get('a').contains('Forgot your password?').should('be.visible').click();

    // Verify that the reset password page is loaded
    cy.url().should('include', '/password/reset'); // Adjust based on your app's routing
  });

  it('should toggle "Remember me" checkbox', () => {
    // Check the checkbox
    cy.get('input[name="remember"]').check().should('be.checked');

    // Uncheck the checkbox
    cy.get('input[name="remember"]').uncheck().should('not.be.checked');
  });
});
