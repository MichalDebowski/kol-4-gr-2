Feature: I would like to edit reptiles

  Scenario Outline: Insert records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/wroclaw/"
    Then I should not see "<wroclaw>"
     And I follow "Create a new entry"
    Then I should see "Reptile creation"
    When I fill in "Name" with "<wroclaw>"
     And I fill in "Caption" with "<caption>"
     And I fill in "Size" with "<size>"
     And I press "Create"
    Then I should see "<wroclaw>"
     And I should see "<caption>"
     And I should see "<size>"

  Examples:
    | wroclaw      | caption | size | 
    | warszawska   | desc1   | 3    |
    | wokulskiego  | desc2   | 6    |
    | solidarnosci | desc3   | 23   |



  Scenario Outline: Edit records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/wroclaw/"
    Then I should not see "<new-wroclaw>"
    When I follow "<old-wroclaw>"
    Then I should see "<old-wroclaw>"
    When I follow "Edit"
     And I fill in "Name" with "<new-wroclaw>"
     And I fill in "Caption" with "<new-caption>"
     And I fill in "Size" with "<new-size>"
     And I press "Update"
     And I follow "Back to the list"
    Then I should see "<new-wroclaw>"
     And I should see "<new-caption>"
     And I should see "<new-size>"
     And I should not see "<old-wroclaw>"

  Examples:
    | old-wroclaw | new-wroclaw  | new-caption | new-size |
    | warszawska  | krakowska    | aleja       | 27       |
    | wokulskiego | okocimska    | ulica       | 1        |


  Scenario Outline: Delete records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/wroclaw/"
    Then I should see "<wroclaw>"
    When I follow "<wroclaw>"
    Then I should see "<wroclaw>"
    When I press "Delete"
    Then I should not see "<wroclaw>"

  Examples:
    | wroclaw      |
    | solidarnosci |
    | okocimska    |
    | krakowska    |