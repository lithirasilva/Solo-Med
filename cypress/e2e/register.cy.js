

describe('Registration Functionality', () => {
  beforeEach(() => {
    // Visit the registration page before each test
    cy.visit('/register');
  });

  it('should display the registration form', () => {
    // Check if the form elements are visible
    cy.get('input[id="name"]').should('be.visible');
    cy.get('input[id="email"]').should('be.visible');
    cy.get('input[id="password"]').should('be.visible');
    cy.get('input[id="password_confirmation"]').should('be.visible');
    cy.get('button[type="submit"]').contains('Register').should('be.visible');
  });

  it('should display validation errors for empty fields', () => {
    // Attempt to submit the form without entering any data
    cy.get('button[type="submit"]').click();

    // Check for error messages for each input
    cy.get('input[id="name"]').then(($input) => {
      cy.wrap($input)
        .parent()
        .find('.mt-2')
        .should('contain.text', 'The name field is required');
    });

    cy.get('input[id="email"]').then(($input) => {
      cy.wrap($input)
        .parent()
        .find('.mt-2')
        .should('contain.text', 'The email field is required');
    });

    cy.get('input[id="password"]').then(($input) => {
      cy.wrap($input)
        .parent()
        .find('.mt-2')
        .should('contain.text', 'The password field is required');
    });

    cy.get('input[id="password_confirmation"]').then(($input) => {
      cy.wrap($input)
        .parent()
        .find('.mt-2')
        .should('contain.text', 'The password confirmation field is required');
    });

    // If the "terms and conditions" checkbox is required
    cy.get('input[id="terms"]').then(($input) => {
      cy.wrap($input)
        .parent()
        .find('.mt-2')
        .should('contain.text', 'The terms field is required');
    });
  });

  it('should show an error message for mismatched passwords', () => {
    // Enter data with mismatched passwords
    cy.get('input[id="name"]').type('John Doe');
    cy.get('input[id="email"]').type('john.doe@example.com');
    cy.get('input[id="password"]').type('password123');
    cy.get('input[id="password_confirmation"]').type('password1234');

    // Submit the form
    cy.get('button[type="submit"]').click();

    // Check if the error message is displayed
    cy.get('input[id="password_confirmation"]').then(($input) => {
      cy.wrap($input)
        .parent()
        .find('.mt-2')
        .should('contain.text', 'The password confirmation does not match');
    });
  });

  it('should successfully register with valid data', () => {
    // Enter valid data
    cy.get('input[id="name"]').type('John Doe');
    cy.get('input[id="email"]').type('john.doe@example.com');
    cy.get('input[id="password"]').type('password123');
    cy.get('input[id="password_confirmation"]').type('password123');

    // Check the "terms and conditions" checkbox
    cy.get('input[id="terms"]').check().should('be.checked');

    // Submit the form
    cy.get('button[type="submit"]').click();

    // Check if redirected to the appropriate page after registration
    cy.url().should('include', '/dashboard'); // Adjust based on your app's routing
  });

  it('should show an error message if "terms and conditions" are not accepted', () => {
    // Enter valid data but do not check the "terms and conditions" checkbox
    cy.get('input[id="name"]').type('John Doe');
    cy.get('input[id="email"]').type('john.doe@example.com');
    cy.get('input[id="password"]').type('password123');
    cy.get('input[id="password_confirmation"]').type('password123');

    // Attempt to submit the form without checking the checkbox
    cy.get('button[type="submit"]').click();

    // Check for the error message related to terms and conditions
    cy.get('input[id="terms"]').then(($input) => {
      cy.wrap($input)
        .parent()
        .find('.mt-2')
        .should('contain.text', 'The terms field is required');
    });
  });
});
