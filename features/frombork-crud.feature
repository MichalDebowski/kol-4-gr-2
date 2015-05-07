Feature: I would like to edit frombork

  Scenario Outline: Insert records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/frombork/"
    Then I should not see "<frombork>"
     And I follow "Create a new entry"
    Then I should see "Frombork creation"
    When I fill in "Name" with "<frombork>"
     And I fill in "Caption" with "<caption>"
     And I fill in "Size" with "<size>"
     And I press "Create"
    Then I should see "<frombork>"
     And I should see "<caption>"
     And I should see "<size>"

  Examples:
    | frombork     | caption  | size |
    | pruska       | ulicapruska    | 123  |
    | pomorska     | ulicapomorska    | 234  |



  Scenario Outline: Edit records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/frombork/"
    Then I should not see "<new-frombork>"
    When I follow "<old-frombork>"
    Then I should see "<old-frombork>"
    When I follow "Edit"
     And I fill in "Name" with "<new-frombork>"
     And I fill in "Caption" with "<new-caption>"
     And I fill in "Size" with "<new-size>"
     And I press "Update"
     And I follow "Back to the list"
    Then I should see "<new-frombork>"
     And I should see "<new-caption>"
     And I should see "<new-size>"
     And I should not see "<old-frombork>"


  Examples:
    | old-frombork   | new-frombork  | new-caption   | new-size   |
    | pruska         | niewiadoma1   | zbedny opis   | 3453       |
    | pomorska       | niewiadoma2   | niewiadoma    | 4563       |

  Scenario Outline: Delete records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/frombork/"
    Then I should see "<frombork>"
    When I follow "<frombork>"
    Then I should see "<frombork>"
    When I press "Delete"
    Then I should not see "<frombork>"


  Examples:
    |  frombork   |
    | niewiadoma1  |
    | niewiadoma2  |