Feature: I would like to edit aleksandrow

  Scenario Outline: Insert records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I follow "Aleksandrow"
    And I go to "/admin/aleksandrow/"
    Then I should not see "<aleksandrow>"
    And I follow "Create a new entry"
    Then I should see "Aleksandrow creation"
    When I fill in "Name" with "<aleksandrow>"
    And I fill in "Caption" with "<caption>"
    And I fill in "Size" with "<size>"
    And I press "Create"
    Then I should see "<aleksandrow>"
    And I should see "<caption>"
    And I should see "<size>"

  Examples:
    | aleksandrow     | caption   | size    |
    | Zielona       | srodmiescie   | 123     |
    | Cicha         | nowa       |     456     |
    | Spokojna      | osiedle   | 789     |



  Scenario Outline: Edit records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I follow "Aleksandrow"
    And I go to "/admin/aleksandrow/"
    Then I should not see "<new-aleksandrow>"
    When I follow "<old-aleksandrow>"
    Then I should see "<old-aleksandrow>"
    When I follow "Edit"
    And I fill in "Name" with "<new-aleksandrow>"
    And I fill in "Caption" with "<new-caption>"
    And I fill in "Size" with "<new-size>"
    And I press "Update"
    And I follow "Back to the list"
    Then I should see "<new-aleksandrow>"
    And I should see "<new-caption>"
    And I should see "<new-size>"
    And I should not see "<old-aleksandrow>"

  Examples:
    | old-aleksandrow     | new-aleksandrow  | new-caption            | new-size|
    | Zielona       | Zlota      |ulica2             |123      | 
    | Cicha         | Lubelska      | miasteczko           |456      |


  Scenario Outline: Delete records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I follow "Aleksandrow"
    And I go to "/admin/aleksandrow/"
    Then I should see "<aleksandrow>"
    When I follow "<aleksandrow>"
    Then I should see "<aleksandrow>"
    When I press "Delete"
    Then I should not see "<aleksandrow>"

  Examples:
    |  aleksandrow    |
    | Zlota      |
    | Lubelska     |
   
