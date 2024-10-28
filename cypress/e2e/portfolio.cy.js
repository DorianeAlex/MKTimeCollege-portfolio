describe('testing MKtime website and functionalities', () => {

  beforeEach(() =>
    // visits the webpage
  cy.visit('http://localhost/codespace/MKTimeCollege-portfolio/index.php')
);
  // use the login button to log as an existing user from the database
  it('click on login to identify a user already in the database', () => {
    cy.get('.login-btn').click()
    // find the input for the email and use an existing email address
    cy.get('.email-input').type('john.doe@example.com')
    // assert that the email address is typed as an input
    cy.get('.email-input').should('have.value', 'john.doe@example.com')
    // enter the password linked to the existing user from the database
    cy.get('.pass-input').type('password')
    // finds the submit button and click on it to get access to the catalogue
    cy.get('.btn').contains('Submit').click()
  });  

  // run another test to find the basket tab and click on it
  it('clicking to view the basket and display message', () => {
    cy.get('.basket').click()
    // look for the message that should be display if no product in the cart
    cy.contains('Your cart is currently empty.')
      // ensure the message is visible
      .should('be.visible') 
      // also check for specified CSS classes
      .and('have.class', 'text-center');
  });
  });

