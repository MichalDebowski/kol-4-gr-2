Feature: I would like to edit lodz

  Scenario Outline: Insert records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I follow "Lodz"
    And I go to "/admin/lodz/"
    Then I should not see "<lodz>"
    And I follow "Create a new entry"
    Then I should see "Lodz creation"
    When I fill in "Name" with "<lodz>"
    And I fill in "Street" with "<street>"
    And I fill in "Size" with "<size>"
    And I press "Create"
    Then I should see "<lodz>"
    And I should see "<street>"
    And I should see "<size>"

  Examples:
    | lodz     | street   | size    |
    | Wiejska       | srodmiescie   | 321     |
    | Zielona         | Blone       |     456     |
    | Pogodna      | Tatary   | 89     |



  Scenario Outline: Edit records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I follow "Lodz "
    And I go to "/admin/lodz/"
    Then I should not see "<new-lodz>"
    When I follow "<old-lodz>"
    Then I should see "<old-lodz>"
    When I follow "Edit"
    And I fill in "Name" with "<new-lodz>"
    And I fill in "Street" with "<new-street>"
    And I fill in "Size" with "<new-size>"
    And I press "Update"
    And I follow "Back to the list"
    Then I should see "<new-lodz>"
    And I should see "<new-street>"
    And I should see "<new-size>"
    And I should not see "<old-lodz>"

  Examples:
    | old-lodz     | new-lodz  | new-street            | new-size|
    | Zielona       | Biala      |srodmiescie             |213      | 
    | Pogodna         | Hetmanska      | slawinek           |456      |


  Scenario Outline: Delete records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I follow "lodz"
    And I go to "/admin/lodz/"
    Then I should see "<lodz>"
    When I follow "<lodz>"
    Then I should see "<lodz>"
    When I press "Delete"
    Then I should not see "<lodz>"

  Examples:
    |  lodz    |
    | Biala      |
    | Hetmanska     |
   
