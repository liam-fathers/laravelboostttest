# Code Style Rules

## PHP Standards
- Use PSR-12 coding standards
- Never add duplicate `<?php` tags
- Always use type hints for method returns
- Use single quotes for strings unless interpolation needed

## Laravel Conventions
- Controllers: singular resource names (UserController, not UsersController)
- Route names: use dot notation (users.index, users.show)
- Only select needed columns in queries
- Use lazy() for large datasets

## Testing
- Use RefreshDatabase trait for database tests
- Keep test names descriptive
- Avoid testing framework behavior, test application logic

## API Responses
- Always wrap responses in JsonResponse
- Include status codes
- Never expose sensitive fields (password, tokens)