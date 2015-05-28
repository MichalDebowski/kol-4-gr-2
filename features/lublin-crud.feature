Feature: I would like to edit lublin

  Scenario Outline: Insert records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I follow "Lublin"
    And I go to "/admin/lublin/"
    Then I should not see "<lublin>"
    And I follow "Create a new entry"
    Then I should see "Lublin creation"
    When I fill in "Name" with "<lublin>"
    And I fill in "Street" with "<street>"
    And I fill in "Size" with "<size>"
    And I press "Create"
    Then I should see "<lublin>"
    And I should see "<street>"
    And I should see "<size>"

  Examples:
    | lublin     | street   | size    |
    | Lubartowska       | srodmiescie   | 723     |
    | Pogodna         | bronowice       |     56     |
    | Hetmanska      | blonie   | 78     |



  Scenario Outline: Edit records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I follow "Lublin"
    And I go to "/admin/lublin/"
    Then I should not see "<new-lublin>"
    When I follow "<old-lublin>"
    Then I should see "<old-lublin>"
    When I follow "Edit"
    And I fill in "Name" with "<new-lublin>"
    And I fill in "Street" with "<new-street>"
    And I fill in "Size" with "<new-size>"
    And I press "Update"
    And I follow "Back to the list"
    Then I should see "<new-lublin>"
    And I should see "<new-street>"
    And I should see "<new-size>"
    And I should not see "<old-lublin>"

  Examples:
    | old-lublin     | new-lublin  | new-street            | new-size|
    | Pogodna       | Szmaragdowa      |widok             |13      | 
    | Hetmanska         | Zamojska      | bronowice           |46      |


  Scenario Outline: Delete records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I follow "Lublin"
    And I go to "/admin/lublin/"
    Then I should see "<lublin>"
    When I follow "<lublin>"
    Then I should see "<lublin>"
    When I press "Delete"
    Then I should not see "<lublin>"

  Examples:
    |  lublin    |
    | Szmaragdowa      |
    | Zamojska     |
   
