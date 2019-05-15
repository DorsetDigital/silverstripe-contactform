<% if $SuccessMessage %>
  $SuccessMessage
<% else %>
  <% if $SiteConfig.FormTitle %>
    <h2 class="title">$SiteConfig.FormTitle</h2>
  <% end_if %>
  <% if $SiteConfig.FormIntro %>
    $SiteConfig.FormIntro
  <% end_if %>
  $AddContactForm
<% end_if %>


