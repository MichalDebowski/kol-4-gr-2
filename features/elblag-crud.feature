Feature: I would like to edit elblag

  Scenario Outline: Insert records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I follow "Elblag"
    And I go to "/admin/elblag/"
    Then I should not see "<elblag>"
    And I follow "Create a new entry"
    Then I should see "Elblag creation"
    When I fill in "Name" with "<elblag>"
    And I fill in "Caption" with "<caption>"
    And I fill in "Size" with "<size>"
    And I press "Create"
    Then I should see "<elblag>"
    And I should see "<caption>"
    And I should see "<size>"

  Examples:
    | elblag     | caption   | size    |
    | Zielona       | srodmiescie   | 123     |
    | Cicha         | nowa       |     456     |
    | Spokojna      | osiedle   | 789     |



  Scenario Outline: Edit records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I follow "Elblag"
    And I go to "/admin/elblag/"
    Then I should not see "<new-elblag>"
    When I follow "<old-elblag>"
    Then I should see "<old-elblag>"
    When I follow "Edit"
    And I fill in "Name" with "<new-elblag>"
    And I fill in "Caption" with "<new-caption>"
    And I fill in "Size" with "<new-size>"
    And I press "Update"
    And I follow "Back to the list"
    Then I should see "<new-elblag>"
    And I should see "<new-caption>"
    And I should see "<new-size>"
    And I should not see "<old-elblag>"

  Examples:
    | old-elblag     | new-elblag  | new-caption            | new-size|
    | Zielona       | Zlota      |ulica2             |123      | 
    | Cicha         | Lubelska      | miasteczko           |456      |


  Scenario Outline: Delete records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I follow "Elblag"
    And I go to "/admin/elblag/"
    Then I should see "<elblag>"
    When I follow "<elblag>"
    Then I should see "<elblag>"
    When I press "Delete"
    Then I should not see "<elblag>"

  Examples:
    |  elblag    |
    | Zlota      |
    | Lubelska     |
   
